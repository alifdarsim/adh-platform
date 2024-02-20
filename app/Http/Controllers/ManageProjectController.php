<?php

namespace App\Http\Controllers;

use App\Models\ProjectShortlist;
use App\Models\ProjectMeeting;
use App\Models\Projects;
use Illuminate\Http\Request;
use Yajra\DataTables\Exceptions\Exception;

class ManageProjectController extends Controller
{
    public function index()
    {
        $expert = auth()->user()->expert;
        $projects = ProjectShortlist::where('expert_id', $expert->id)->get();
        $projects_count = $projects->count();
        return view('expert.projects.index', compact('projects_count'));
    }

    public function show($pid)
    {
        $project = Projects::where('pid', $pid)->first();
//        $project->budget = $this->formatBudget($project->budget);
        if (!$project) {
            abort(404);
        }
        $invited_project = ProjectInvitationController::where('project_id', $project->id)->where('expert_id', auth()->user()->expert->id)->first();
        if (!$invited_project) {
            return view('expert.projects.not-invited');
        }
        if ($project->status == 'awarded'){
            return view('expert.projects.awarded', [
                'project' => $project,
                'invite_accepted' => $invited_project->accepted,
            ]);
        }
        return view('expert.projects.show', [
            'project' => $project,
            'invite_accepted' => $invited_project->accepted,
        ]);
    }

    /**
     * Show the datatable data of all deals.
     * @throws Exception
     * @throws \Exception
     */
    public function data()
    {
        // Fetch projects where the currently authenticated expert is invited
        $projects = Projects::where([['status', '!=', 'draft'], ['status', '!=', 'archived']])
            ->whereHas('invitedExperts', function ($query) {
                $query->where('expert_id', auth()->user()->expert->id);
            })
            ->with('client', 'invited')
            ->get();

        // Now, you can access the client name without additional subqueries
        $projects->each(function ($project) {
            $project->client_name = $project->client->name;
            $project->accept_invitation = $project->invited->accepted;
        });

        return datatables()->of($projects)
            ->addColumn('action', function ($project) {
                return '<a href="' . route('expert.manage.project.show', $project->pid) . '" class="btn btn-sm btn-primary">View</a>';
            })
            ->addColumn('pid', function ($project) {
                return $project->pid;
            })
            ->addColumn('title', function ($project) {
                return $project->title;
            })
            ->addColumn('budget', function ($project) {
                return $project->budget;
            })
            ->addColumn('client_name', function ($project) {
                return $project->client_name;
            })
            ->addColumn('deadline', function ($project) {
                return $project->deadline;
            })
            ->addColumn('accept', function ($project) {
                return $project->accept_invitation;
            })
            ->addColumn('status', function ($project) {
                return $project->status;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    function formatBudget($budget) {
        if ($budget === null) {
            return null;
        }
        $budgetRange = json_decode($budget);
        return array_map(function($value) {
            if ($value >= 1000000) {
                return round($value / 1000000, 1) . 'M';
            } elseif ($value >= 1000) {
                return round($value / 1000, 1) . 'k';
            }
            return $value;
        }, $budgetRange);
    }


}
