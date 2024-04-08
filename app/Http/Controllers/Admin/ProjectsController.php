<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ExpertList;
use App\Models\Hub;
use App\Models\Keyword;
use App\Models\PaymentExpert;
use App\Models\ProjectExpert;
use App\Models\ProjectPayment;
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

    function generateUniqueID() {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $unique_id = '';

        // Loop 10 times to generate a 10-character ID
        for ($i = 0; $i < 10; $i++) {
            $unique_id .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $unique_id;
    }

    public function show($pid){
        $countries = Country::select('id', 'name')->get();
        $project = Projects::where('pid',$pid)->first();
        if (!$project) return view('errors.not-exist');
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
        $pid = Str::uuid();
        $project = Projects::create([
            'name' => request()->get('name'),
            'company_id' => request()->get('company_id'),
            'description' => request()->get('description'),
            'hub_id' => request()->get('hub'),
            'pid' => $this->generateUniqueID(),
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
            ->addColumn('handle_by', function ($project) {
                return $project->handleBy->name ?? '-';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function datatable_expert($pid)
    {
        $project = Projects::where('pid',$pid)->first();
        $shortlist = ProjectExpert::where('project_id', $project->id)
            ->with('expert_email')
            ->get();
        $shortlist->transform(function ($item) {
            $item->email = $item->expert->email;
            return $item;
        });
        $answer = $project->answer ?? collect();
        return datatables()->of($shortlist)
            ->addColumn('registered', function ($e) {
                $email = $e->email;
                $user = User::where('email', $email)->first();
                return (bool)$user;
            })
            ->addColumn('payment', function ($shortlist) {
                return $shortlist->payment->amount ?? null;
            })
            ->addColumn('answers', function ($shortlist) use ($answer) {
                if (User::where('email', $shortlist->email)->first() === null) return null;
                $user_id = User::where('email', $shortlist->email)->first()->id;
                return $answer->firstWhere('user_id', $user_id)->answers ?? null;
            })
            ->make(true);
    }

    public function award($project_id, $expert_id, MailSender $mailSender){
        $project = Projects::find($project_id);
        $project_expert = ProjectExpert::where('project_id',$project_id)->where('expert_id',$expert_id)->first();
        $project_expert->awarded = 1;
        $project_expert->save();
        $email = $project_expert->expert->email;
        $user = User::where('email',$email)->first();
        if (!$user) return error('Expert is not registered yet');
        $mailSender->sendProjectAwarded($email, $project->name);
        return success('Expert awarded successfully');
    }

    public function setPayment($project_id, $expert_id){
        $amount = request()->get('payment_amount');
        $project_expert = ProjectExpert::where('project_id',$project_id)->where('expert_id',$expert_id)->first();
        $expert_payment = $project_expert->payment;
        if (!$expert_payment) {
            $expert_payment = $project_expert->payment()->create();
            $expert_payment->status = 'pending';
        }
        $expert_payment->amount = $amount;
        $expert_payment->save();
        return success('Payment set successfully');
    }

    public function award_expert($pid, MailSender $mailSender){
        $expert_ids = request()->get('expert_ids');
        $emails = ExpertList::whereIn('id',$expert_ids)->get()->pluck('email');
        $users = User::whereIn('email',$emails)->get();

        $project = Projects::where('pid',$pid)->first();
        //remove all awarded expert
        $project->award()->delete();
        // award expert
        foreach ($users as $user){
            $project_award = $project->award()->create();
            $token = Str::uuid();
            $project_award->token = $token;
            $mailSender->sendProjectAwarded($user->email, $project->name, $token);
            $project_award->save();
        }
        $project->status = 'contract';
        $project->save();
        return success('Expert awarded successfully');
    }

    public function force_accept($project_id, $id){
        $expert = ExpertList::find($id);
        $email = $expert->email;
        $user = User::where('email',$email)->first();
        if (!$user) return error('Expert is not registered yet');
        $project_expert = ProjectExpert::where('project_id',$project_id)->where('expert_id',$id)->first();
        $project_expert->accepted = 1;
        $project_expert->save();
        return success('Expert accepted successfully');
    }

    public function expert_remove($pid, $id){
        $_id = Projects::where('pid',$pid)->first()->id;
        $project_expert = ProjectExpert::where('project_id', $_id)->where('expert_id', $id)->first();
        $project_expert->delete();
        return success('Expert removed successfully');
    }

    public function respond($pid)
    {
        $status = request()->get('status');
        $id = Projects::where('pid',$pid)->first()->id;
        $project = Projects::find($id);
        $project->status = $status;
        if ($status == 'shortlisted') {
            $project->published_at = Carbon::now();
            $project->handle_by = auth()->user()->id;
        }
        else if ($status == 'reject') $project->published_at = null;
        $project->save();
        if ($status == 'active') return success('Project approved successfully');
        else if ($status == 'reject') return success('Project is rejected');
        else return success('Project Approve');
    }


//    public function payment($pid)
//    {
//        $project = Projects::where('pid',$pid)->first();
//        $project->status = 'payment';
//        $project->save();
//        return success('Project is complete, now you can make payment to the expert');
//    }

    public function payment_amount($pid)
    {
        $project = Projects::where('pid',$pid)->first();

        $type = request()->get('type');
        if ($type == 'client') {
            $project_payment = $project->payment()->create();
            $project_payment->received_amount = request()->get('amount');
            $project_payment->received_status = 'pending';
        }
        else{
            $expert_id = request()->get('expert_id');
            $project_payment = $project->payment()->where('expert_id',$expert_id)->first();
            if (!$project_payment) $project_payment = $project->payment()->create();
            $project_payment->released_amount = request()->get('amount');
            $project_payment->expert_id = $expert_id;
            $project_payment->released_status = 'pending';
        }
        $project_payment->save();
        return success('Payment amount added successfully');
    }

    public function reset($pid)
    {
        $project = Projects::where('pid',$pid)->first();
        $project->status = 'pending';
        $project->published_at = null;
        $project->handle_by = null;
        $project->save();
        ProjectExpert::where('project_id',$project->id)->delete();
        return success('Project reset successfully');
    }

    public function start($pid)
    {
        $project = Projects::where('pid',$pid)->first();
        $project->status = 'started';
        if (!$project->payment) return error('No payment info created yet, please add payment amount first');
        $project->save();
        $project->payment->confirm = 1;
        $project->payment->save();
        return success('Project started successfully');
    }


    public function close($pid)
    {
        $project = Projects::where('pid',$pid)->first();
        $project->status = 'closed';
        $project->save();
        return success('Project closed successfully');
    }

    public function add_expert(){
        $project = Projects::where('pid',request()->get('pid'))->first();
        $check = ProjectExpert::where('project_id',$project->id)->where('expert_id',request()->get('expert_id'))->first();
        if ($check) return error('Expert is already added');
        ProjectExpert::create([
            'project_id' => $project->id,
            'expert_id' => request()->get('expert_id')
        ]);
        return success('Expert added successfully');
    }

    public function invite_expert($project_id, $expert_id, MailSender $mailSender){
        $expert = ExpertList::find($expert_id);
        $email = $expert->email;
        if (!$email) return error('Expert email is needed to send the invitation');
        $project = Projects::find($project_id);


        $related_projects = Projects::where('id', '!=', $project_id)
            ->get();
        $related_projects->load('projectTargetInfo.industry');
        $related_projects = $related_projects->filter(function ($related_project) use ($project) {
            return $related_project->projectTargetInfo->industry->id === $project->projectTargetInfo->industry->id;
        });

        // send email to expert
        $project_expert = ProjectExpert::where('project_id',$project_id)->where('expert_id',$expert_id)->first();
        $invited_token = Str::uuid();
        $project_expert->invited = 1;
        $project_expert->invited_token = $invited_token;
        $project_expert->save();
        $mailSender->sendProjectInvitation(
            $email,
            $expert->name,
            $project->name,
            'Contentttttt' ,
            route('project-invitation.index', $invited_token),
            $related_projects
        );
        return success('Expert invited successfully');
    }

    public function invite_expert_all($project_id, MailSender $mailSender){
        $project = Projects::find($project_id);
        $experts_shortlisted = ProjectExpert::where('project_id',$project_id)->with('expert')->get();
        foreach ($experts_shortlisted as $expert){
            $email = $expert->expert->email;
            if (!$email) continue;
            $invited = ProjectInvited::where('email',$email)->where('project_id',$project_id)->first();
            if ($invited) continue;
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

}
