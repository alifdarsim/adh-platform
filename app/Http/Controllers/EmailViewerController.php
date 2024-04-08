<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class EmailViewerController extends Controller
{
    public function index($pid)
    {
        $project = Projects::where('pid', $pid)->first();
        $related_projects = Projects::where('id', '!=', $project->id)
            ->get();
        $related_projects->load('projectTargetInfo.industry');
        $related_projects = $related_projects->filter(function ($related_project) use ($project) {
            return $related_project->projectTargetInfo->industry->id === $project->projectTargetInfo->industry->id;
        });
        return view('mail.project_invitation', compact('project', 'related_projects'));
    }
}
