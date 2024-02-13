<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\Hub;
use App\Models\Keyword;
use App\Models\ProjectExpert;
use App\Models\Projects;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Psr\Container\ContainerExceptionInterface;
use App\Mail\MailSender;
use Str;

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

    public function edit()
    {
        return view('admin.projects.edit');
    }

    public function show($pid){
        $project = Projects::where('pid',$pid)->first();
        if ($project->status == 'awarded') {
            return view('admin.projects.awarded.index', compact('project'));
        }
        $project->targetCountries;
        $project->projectTargetInfo;
        $project->created_by = $project->created_by()->first();
        return view('admin.projects.show', compact('project'));
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
//        return $project;
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
                return $project->created_by()->first()->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function datatable_expert($pid)
    {
        //TODO: optimize all datatable queries
        $id = Projects::where('pid',$pid)->first()->id;
        $experts = ProjectExpert::where('project_id', $id)->with('expert')->get();
        return datatables()->of($experts)
            ->make(true);
    }

    public function datatable_awarding($pid)
    {
        $id = Projects::where('pid',$pid)->first()->id;
        $experts = ProjectExpert::where('project_id', $id)->with('expert')->get();
        $experts = $experts->filter(function($expert){
            return $expert->accepted != null;
        });
        return datatables()->of($experts)
            ->make(true);
    }

    public function award_expert($pid){
        $expert_id = request()->get('expert_id');
        // get user_id from expert_id
        $user_id = User::where('expert_id',$expert_id)->first()->id;
        $project = Projects::where('pid',$pid)->first();
        $project->awarded_at = now();
        $project->awarded_to = $user_id;
        $project->status = 'awarded';
        $project->save();
        return success('Expert awarded successfully');
    }


    public function expert_remove($pid, $id){
        $_id = Projects::where('pid',$pid)->first()->id;
        $project = ProjectExpert::where('project_id', '=', $_id)
            ->where('expert_id', '=',$id)
            ->first();
        $project->delete();
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

    public function add_expert(){
        $project = Projects::where('pid',request()->get('pid'))->first();
        // check if expert is already addede
        $check = ProjectExpert::where('project_id',$project->id)->where('expert_id',request()->get('expert_id'))->first();
        if ($check) return error('Expert is already added');
        ProjectExpert::create([
            'project_id' => $project->id,
            'expert_id' => request()->get('expert_id')
        ]);
        return success('Expert added successfully');
    }

    public function invite_expert($id, MailSender $mailSender){
        $check = ProjectExpert::find($id);
        if ($check->status == 'invited') return error('Expert is already invited');
        // check expert email is set
        $expert = Expert::find($check->expert_id);
        if (!$expert->email) return error('Expert email is needed to send the invitation');
        // send email to expert
        $email = $expert->email;
        $project = Projects::find($check->project_id);
        $token = Str::uuid();
        $mailSender->sendProjectInvitation($email, $expert->name, $project->name, route('project-invitation.index', $token));
        $check->token = $token;
        $check->invited = 1;
        $check->invited_at = now();
        $check->save();
        return success('Expert invited successfully');
    }
}
