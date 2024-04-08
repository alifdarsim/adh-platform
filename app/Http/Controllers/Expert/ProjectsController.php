<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\ProjectAnswer;
use App\Models\ProjectInvited;
use App\Models\ProjectExpert;
use App\Models\Projects;
use App\Models\UserReport;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $project_expert = ProjectExpert::where('expert_id', auth()->user()->expert_list->id)->get();
        return view('expert.project.index', compact('project_expert'));
    }

    public function datatable()
    {
        $project_expert = ProjectExpert::where('expert_id', auth()->user()->expert_list->id)->get();
        return datatables()->of($project_expert)
            ->addColumn('project_name', function ($project_expert) {
                return $project_expert->project->name;
            })
            ->addColumn('client', function ($project_expert) {
                return $project_expert->project->company->name;
            })
//            ->addColumn('invited_at', function ($project_expert) {
//                dd($project_expert);
//                return $project_expert->project->invited->first()->created_at;
//            })
//            ->addColumn('accepted', function ($project_expert) {
//                return $project_expert->project->invited_user_accepted();
//            })
            ->addColumn('deadline', function ($project_expert) {
                return $project_expert->project->deadline;
            })
            ->addColumn('pid', function ($project_expert) {
                return $project_expert->project->pid;
            })
            ->addColumn('status', function ($project_expert) {
                return $project_expert->status;
            })
            ->make(true);
    }

    public function respond(){
        $projects = Projects::where('pid', request('pid'))->first();
        $respond = filter_var(request('respond'), FILTER_VALIDATE_BOOLEAN);;
        $project_expert = ProjectInvited::where('project_id', $projects->id)->where('email', auth()->user()->email)->first();
        $project_expert->accepted = $respond;
        $project_expert->respond_at = now();
        $project_expert->save();
        if ($respond){
            return success('You successfully shortlisted as potential expert to work on this project. You will receive an email and notification when the client award the project to you. <br><br>*To increase your chance in awarded for this project, make sure to answer the client enquiries.',
                ['accepted' => true]);
        }
        return success('Project #'.$projects->pid.' rejected successfully', ['accepted' => false]);
    }

    public function report()
    {
        request()->validate([
            'reason' => 'required'
        ]);
        $reason = request('reason');
        $pid = request('pid');
        $id = Projects::where('pid', $pid)->first()->id;
        $details = request('detail');
        // check if user already reported this project
        $user_report = UserReport::where('user_id', auth()->user()->id)->where('topic_id', $id)->where('topic_model', 'app/Models/Projects')->first();
        if ($user_report) {
            return success('You already reported this project previously. We will review your report and take action if necessary.');
        }
        UserReport::create([
            'user_id' => auth()->user()->id,
            'topic_model' => 'app/Models/Projects',
            'topic_id' => $id,
            'reason' => $reason,
            'details' => $details,
        ]);
        return success('Project #'.$pid.' reported successfully. We will review your report and take action if necessary.');
    }

    public function show($pid){
        $project = Projects::where('pid', $pid)->first();
        if (!$project) return view('errors.not-exist');
        $project_expert = ProjectExpert::where('project_id', $project->id)
            ->where('expert_id', auth()->user()->expert_list->id)
            ->first();
        if ($project_expert->status == 'shortlisted' && !$project_expert->project->public){
            return view('errors.uninvited');
        }
//        return $project_expert;
        return view('expert.project.show.index', compact('project', 'project_expert'));
    }

    public function answer_enquiries(){
        $pid = request('pid');
        $id = Projects::where('pid', $pid)->first()->id;
        $overwrite = request('overwrite');
        $overwrite = filter_var($overwrite, FILTER_VALIDATE_BOOLEAN);
        if ($overwrite) ProjectAnswer::where('user_id', auth()->user()->id)->where('project_id', $id)->delete();
        if (ProjectAnswer::where('user_id', auth()->user()->id)->where('project_id', $id)->first()){
            return error('You already answered the client questions.<br><br>Do you want to overwrite the answer instead?', ['answered' => true]);
        }
        $answers = request('answers');
        ProjectAnswer::create([
            'project_id' => $id,
            'user_id' => auth()->user()->id,
            'answers' => $answers
        ]);
        return success('You have successfully answered the client questions');
    }
}
