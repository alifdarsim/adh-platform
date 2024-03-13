<?php

namespace App\Http\Controllers;

use App\Models\ExpertList;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectAwardedController extends Controller
{
    public function index($token)
    {
        $project = Projects::where('awarded_token', $token)->first();
        if (!$project) return view('errors.expired');
        $user = User::find($project->awarded_to);
        // logout current user if any
        if (auth()->check()) {
            auth()->logout();
        }
        // check user id from expert email
        auth()->loginUsingId($user->id);
        session(['user_type' => 'expert']);
        return redirect()->route('expert.awarded.show', $project->pid)->with('message', 'Awarded project');
//        return view('expert.projects.', compact('project'));
    }
}
