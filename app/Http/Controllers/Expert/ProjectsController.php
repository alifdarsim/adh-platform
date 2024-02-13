<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\ProjectAnswer;
use App\Models\ProjectExpert;
use App\Models\Projects;
use App\Models\UserReport;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $expert = auth()->user()->expert;
        $projects_count = 0;
        if ($expert != null){
            $projects = ProjectExpert::where('expert_id', $expert->id)->get();
            $projects_count = $projects->count();
        }
        return view('expert.projects.index', compact('projects_count'));
    }

    public function datatable()
    {
        $expertId = auth()->user()->expert->id;
        $project_expert = ProjectExpert::whereHas('project', function ($query) {
            $query->where('status', '!=', 'pending');
        })->where('expert_id', $expertId)->with('project')->get();
        return datatables()->of($project_expert)
            ->addColumn('project_name', function ($project_expert) {
                return $project_expert->project->name;
            })
            ->addColumn('client', function ($project_expert) {
                return $project_expert->project->created_by()->first()->name;
            })
            ->addColumn('invited_at', function ($project_expert) {
                return $project_expert->invited_at;
            })
            ->addColumn('deadline', function ($project_expert) {
                return $project_expert->project->deadline;
            })
            ->addColumn('pid', function ($project) {
                return $project->project->pid;
            })
            ->addColumn('status', function ($project) {
                return $project->project->status;
            })
            ->make(true);
    }

    public function respond(){
        $projects = Projects::where('pid', request('pid'))->first();
        $respond = filter_var(request('respond'), FILTER_VALIDATE_BOOLEAN);;
        $project_expert = ProjectExpert::where('project_id', $projects->id)->where('expert_id', auth()->user()->expert->id)->first();
        $project_expert->accepted = $respond;
        $project_expert->respond_at = now();
        $project_expert->save();
        if ($respond){
            return success('You successfully shortlisted as potential expert to work on this project. You will receive an email and notification when the client award the project to you. <br><br>*To increase your chance in selected as expert, make sure to answer the client questions.',
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
        $status = Projects::where('pid', $pid)->first()->status;
        if ($status == 'awarded') {
            return redirect()->route('expert.awarded.show', $pid);
        }
        $project = Projects::where('pid', $pid)->where('status', '<>', 'pending')->first();
        if (!$project) return view('errors.not-exist');
        $invited_project = ProjectExpert::where('project_id', $project->id)->where('expert_id', auth()->user()->expert->id)->first();
        if (!$invited_project) return view('errors.uninvited');
        $project = $invited_project->project;
        $invitation_accepted = $invited_project->accepted;
        return view('expert.projects.show', compact('project', 'invitation_accepted', 'invited_project'));
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
