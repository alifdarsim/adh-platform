<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ExpertList;
use App\Models\Hub;
use App\Models\Keyword;
use App\Models\ProjectInvited;
use App\Models\ProjectShortlist;
use App\Models\Projects;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use App\Mail\MailSender;

class ProjectsController extends Controller
{
    public function index()
    {
        return view('admin.projects.index');
    }

    public function create()
    {
        return view('admin.projects.create',['hubs'=>Hub::all()]);
    }

    public function show($pid){
        $countries = Country::select('id', 'name')->get();
        $project = Projects::where('pid',$pid)->first();
        if (!$project) return view('errors.not-exist');
        if ($project->status == 'awarded' || $project->status == 'closed'){
            return view('admin.projects.awarded.index', compact('project'));
        }
        $project->targetCountries;
        $project->projectTargetInfo;
        $project->created_by = $project->createdBy;
        return view('admin.projects.show.index', compact('project', 'countries'));
    }

    public function destroy($pid){
        $id = Projects::where('pid',$pid)->first()->id;
        $project = Projects::find($id);
        $project->delete();
        return success('Project deleted successfully');
    }

    /**
     * Purpose: store project in database and return response
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     */
    public function store(){
        if(!request()->company_id) return error('Company for this project is required');
        $questions = request()->get('target_question');
        // get not null questions
        $questions = array_filter($questions, function($question){
            return $question != null;
        });
        if (count($questions) < 1) return error('You need to ask at least one question to the expert');
        $project = Projects::create([
            'name' => request()->get('name'),
            'company_id' => request()->get('company_id'),
            'description' => request()->get('description'),
            'hub_id' => request()->get('hub'),
            'pid' => Str::replace('-', '', Str::uuid()),
            'budget' => request()->get('budget'),
            'status' => 'pending',
            'created_by' => auth()->user()->id,
            'deadline' => Carbon::createFromFormat('d/m/Y', request()->get('deadline'))->format('Y-m-d'),
            'questions' => $questions
        ]);
        $project->targetCountries()->sync(request()->get('target_country'));
        $project->projectTargetInfo()->create([
            'industry_id' => request()->get('target_industry'),
            'company_size' => request()->get('target_company_size'),
            'communication_language' => json_encode(request()->get('communication_language')),
        ]);
        foreach (request()->get('target_keyword') as $keyword) {
            $keyword = Keyword::firstOrCreate(['name' => $keyword]);
            $keywordIds[] = $keyword->id;
        }
        $project->keywords()->sync($keywordIds);
        return success('Project created successfully');
    }

    public function datatable()
    {
        $project = Projects::with('company')->get();
        return datatables()->of($project)
            ->addColumn('action', function ($project) {
                return '<a href="' . route('admin.projects.edit', $project->id) . '" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->addColumn('name', function ($project) {
                return $project->name;
            })
            ->addColumn('company', function ($project) {
                return $project->company->name;
            })
            ->addColumn('target_countries', function ($project) {
                return json_decode($project->targetCountries);
            })
            ->addColumn('company_img', function ($project) {
                return $project->company->img_url;
            })
            ->addColumn('hub', function ($project) {
                return $project->hub->name;
            })
            ->addColumn('description', function ($project) {
                return $project->description;
            })
            ->addColumn('deadline', function ($project) {
                $deadline = $project->deadline;
                $deadline = date('d-m-Y', strtotime($deadline));
                $date1 = date_create($deadline);
                $date2 = date_create(date('d-m-Y'));
                $diff = date_diff($date2, $date1);
                $string = $diff->format("%R%a days");
                if ($string[0] == '-') return 'Expired';
                else return substr($string, 1);
            })
            ->addColumn('created_by', function ($project) {
                return $project->createdBy->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function datatable_shortlist($pid)
    {
        $project = Projects::where('pid',$pid)->first();
        $shortlist = ProjectShortlist::where('project_id', $project->id)
            ->with('expert_email')
            ->get();
        $shortlist->transform(function ($item) {
            $item->email = $item->expert->email;
            return $item;
        });
        $answer = $project->answer;
        $invitation = ProjectInvited::where('project_id', $project->id)->get();
        return datatables()->of($shortlist)
            ->addColumn('invited', function ($shortlist) use ($invitation) {
                $email = $shortlist->email;
                $invited = $invitation->first(function ($item) use ($email) {
                    return $item->email == $email;
                });
                return $invited !== null;
            })
            ->addColumn('answers', function ($shortlist) use ($invitation, $answer) {
                if (User::where('email', $shortlist->email)->first() === null) return null;
                $user_id = User::where('email', $shortlist->email)->first()->id;
                return $answer->where('user_id', $user_id)->first()->answers;
            })
            ->addColumn('accepted', function ($shortlist) use ($invitation) {
                $email = $shortlist->email;
                $invited = $invitation->first(function ($item) use ($email) {
                    return $item->email == $email;
                });
                if ($invited === null) return null;
                else return $invited->accepted;
            })
            ->make(true);
    }

    public function datatable_awarding($pid)
    {
        $id = Projects::where('pid',$pid)->first()->id;
        $experts = ProjectInvited::where('project_id', $id)->with('expert')->get();
        $experts = $experts->filter(function($expert){
            return $expert->accepted != null;
        });
        return datatables()->of($experts)
            ->make(true);
    }

    public function award_expert($pid, MailSender $mailSender){
        $expert_id = request()->get('expert_id');
        // get user_id from expert_id
        $token = Str::uuid();
        $email = ExpertList::where('id',$expert_id)->first()->email;
        $user_id = User::where('email',$email)->first()->id;
        $project = Projects::where('pid',$pid)->first();
        $project->awarded_at = now();
        $project->awarded_to = $user_id;
        $project->status = 'awarded';
        $project->awarded_token = $token;
        $project->save();
        $mailSender->sendProjectAwarded($email, $project->name, $token);
        return success('Expert awarded successfully');
    }


    public function expert_remove($pid, $id){
        $_id = Projects::where('pid',$pid)->first()->id;
        $project = ProjectShortlist::where('project_id', '=', $_id)
            ->where('expert_id', '=',$id)
            ->first();
        $project->delete();
        $expert = ExpertList::find($id);
        $email = $expert->email;
        $invited = ProjectInvited::where('email',$email)->where('project_id',$_id)->first();
        $invited?->delete();
        return success('Expert removed successfully');
    }

    public function respond($pid)
    {
        $status = request()->get('status');
        $id = Projects::where('pid',$pid)->first()->id;
        $project = Projects::find($id);
        $project->status = $status;
        if ($status == 'active') $project->published_at = Carbon::now();
        else if ($status == 'reject') $project->published_at = null;
        $project->save();
        if ($status == 'active') return success('Project approved successfully');
        else if ($status == 'reject') return success('Project is rejected');
        else return success('Project set to pending');
    }

    public function close($pid)
    {
        $project = Projects::where('pid',$pid)->first();
        $project->status = 'closed';
        $project->save();
        return success('Project closed successfully');
    }

    public function reset($pid)
    {
        $project = Projects::where('pid',$pid)->first();
        $project->status = 'pending';
        $project->awarded_to = null;
        $project->awarded_at = null;
        $project->awarded_token = null;
        $project->save();
        ProjectShortlist::where('project_id',$project->id)->delete();
        ProjectInvited::where('project_id',$project->id)->delete();
        return success('Project reset successfully');
    }

    public function add_expert(){
        $project = Projects::where('pid',request()->get('pid'))->first();
        $check = ProjectShortlist::where('project_id',$project->id)->where('expert_id',request()->get('expert_id'))->first();
        if ($check) return error('Expert is already added');
        ProjectShortlist::create([
            'project_id' => $project->id,
            'expert_id' => request()->get('expert_id')
        ]);
        return success('Expert added successfully');
    }

    public function invite_expert($project_id, $expert_id, MailSender $mailSender){
        $expert = ExpertList::find($expert_id);
        $email = $expert->email;
        if (!$email) return error('Expert email is needed to send the invitation');
//        $invited = ProjectInvited::where('email',$email)->where('project_id',$project_id)->first();
//        if ($invited) return error('Expert is already invited');
        $project = Projects::find($project_id);
        // send email to expert
        $invited = new ProjectInvited();
        $token = Str::uuid();
        $mailSender->sendProjectInvitation($email, $expert->name, $project->name, 'Contentttttt' ,route('project-invitation.index', $token));
        $invited->email = $email;
        $invited->project_id = $project_id;
        $invited->token = $token;
        $invited->save();
        return success('Expert invited successfully');
    }

    public function invite_expert_all($project_id, MailSender $mailSender){
        $project = Projects::find($project_id);
        $experts_shortlisted = ProjectShortlist::where('project_id',$project_id)->with('expert')->get();
//        $list = [];
        foreach ($experts_shortlisted as $expert){
            $email = $expert->expert->email;
            if (!$email) continue;
            $invited = ProjectInvited::where('email',$email)->where('project_id',$project_id)->first();
            if ($invited) continue;
//            $list[] = $email;
            // send email to expert
            $invited = new ProjectInvited();
            $token = Str::uuid();
            $mailSender->sendProjectInvitation($email, $expert->name, $project->name, 'Contentttttt' ,route('project-invitation.index', $token));
            $invited->email = $email;
            $invited->project_id = $project_id;
            $invited->token = $token;
            $invited->save();
        }
        return success('Expert invited successfully');
    }

    public function payment($pid)
    {
        $amount = request()->get('payment');
        $project = Projects::find($pid);
        $project->amount = $amount;
        $project->save();
        return success('Project payment successful');
    }
}
