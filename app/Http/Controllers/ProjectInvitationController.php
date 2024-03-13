<?php

namespace App\Http\Controllers;

use App\Models\ProjectInvited;
use App\Models\Projects;
use App\Models\ProjectShortlist;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectInvitationController extends Controller
{
    public function index($token){
        $project_invited = ProjectInvited::where('token',$token)->first();
        $project = Projects::where('id', $project_invited->project_id)->first();
        $email = $project_invited->email;
        // if user with email exists, then login
        if ($user = User::where('email', $email)->first()) {
            if (auth()->check()) {
                auth()->logout();
            }
            auth()->loginUsingId($user->id);
            session(['user_type' => 'expert']);
            return redirect()->route('expert.projects.show', ['pid' => $project->pid]);
        }
        // if user with email does not exist, then redirect to register page
        return redirect()->route('register.index')->with('email', $email);
    }
}
