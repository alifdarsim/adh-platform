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
        $project_expert = auth()->user()?->expert?->id
            ? ProjectExpert::where('expert_id', auth()->user()->expert->id)
                ->whereIn('status', ['ongoing', 'complete'])
                ->get()
            : collect();
        return view('expert.project.index', compact('project_expert'));
    }

    public function invited()
    {
        $project_expert = ProjectExpert::whereHas('expert', function ($query) {
            $query->where('id', auth()->user()->expert->id ?? null);
        })
            ->where('status', null)
            ->where('invited', 1)
            ->get();
        return view('expert.project.invited', compact('project_expert'));
    }

    public function public()
    {
        $projects = Projects::where('public', true)->get();
        return view('expert.project.public', compact('projects'));
    }

    public function public_show($pid)
    {
        $project = Projects::where('pid', $pid)->first();
        if (!$project->public) return view('errors.not-exist');
        if (!$project) return view('errors.not-exist');
        return view('expert.project.show.public', compact('project'));
    }

    public function datatable()
    {
        $project_expert = ProjectExpert::where('expert_id', auth()->user()->expert->id)
            ->whereIn('status', ['ongoing', 'complete'])
            ->get();
        return datatables()->of($project_expert)
            ->addColumn('project_name', function ($project_expert) {
                return $project_expert->project->name;
            })
            ->addColumn('client', function ($project_expert) {
                return $project_expert->project->company->name;
            })
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

    public function datatable_invited()
    {
        $project_expert = ProjectExpert::where('expert_id', auth()->user()->expert->id)
            ->where('status', null)
            ->where('invited', 1)
            ->get();
        return datatables()->of($project_expert)
            ->addColumn('project_name', function ($project_expert) {
                return $project_expert->project->name;
            })
            ->addColumn('client', function ($project_expert) {
                return $project_expert->project->company->name;
            })
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

    public function datatable_public()
    {
        $projects = Projects::where('public', true)->get();
        return datatables()->of($projects)
            ->addColumn('project_name', function ($project) {
                return $project->name;
            })
            ->addColumn('client', function ($project) {
                return $project->company->name;
            })
            ->addColumn('deadline', function ($project) {
                return $project->deadline;
            })
            ->addColumn('pid', function ($project) {
                return $project->pid;
            })
            ->addColumn('status', function ($project) {
                return $project->status;
            })
            ->make(true);
    }

    public function respond(){
        $project_expert_id = request('project_expert_id');
        $respond = request('respond');
        if ($respond == 'accept') $respond = true;
        else $respond = false;
        $project_expert = ProjectExpert::where('id', $project_expert_id)->first();
        $project_expert->accepted = $respond;
        $project_expert->respond_at = now();
        $project_expert->save();
        if ($respond){
            return success('You have accepted the project invitation. You can now view the project details on the manage project page.', ['accepted' => true]);
        }
        return success('Project declined successfully.', ['accepted' => false]);
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
            ->where('expert_id', auth()->user()->expert->id ?? null)
            ->first();
        if ($project_expert && $project_expert->status == 'shortlisted' && !$project_expert->project->public){
            return view('errors.uninvited');
        }
        if ($project_expert == null && $project->public){
            return view('expert.project.show.public', compact('project', 'project_expert'));
        }
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
