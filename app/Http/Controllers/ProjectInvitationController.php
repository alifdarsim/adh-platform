<?php

namespace App\Http\Controllers;

use App\Models\ProjectInvited;
use App\Models\Projects;
use App\Models\ProjectShortlist;
use Illuminate\Http\Request;

class ProjectInvitationController extends Controller
{
    public function index($token){
        $project_id = ProjectInvited::where('token',$token)->first()->project_id;
        $project = Projects::where('id',$project_id)->first();
        return redirect()->route('expert.projects.show', ['pid' => $project->pid]);
//        $project = ProjectInvited::where('token',$token)->first();
//        if(!$project) return view('errors.404');
//        $project_id = $project->project_id;
//        // get expert email and name
//        $expert = $project->expert()->first();
//        $email = $expert->email;
//        $name = $expert->name;
//
//        return view('project_invitation',[
//            'project' => $project,
//            'email' => $email,
//            'name' => $name,
//            'token' => $token,
//        ]);
    }
}
