<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\ProjectExpert;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectInvitationController extends Controller
{
    public function index($token){
        $project_expert= ProjectExpert::where('invited_token',$token)->first();
        $email = $project_expert->expert->email;
        // if user with email exists, then login
        if ($user = User::where('email', $email)->first()) {
            if (auth()->check()) {
                auth()->logout();
            }
            auth()->loginUsingId($user->id);
            session(['user_type' => 'expert']);
            return redirect()->route('expert.projects.show', ['pid' => $project_expert->project->pid]);
        }
        // if user with email does not exist, then redirect to register page
        return redirect()->route('register.index')->with('email', $email);
    }
}
