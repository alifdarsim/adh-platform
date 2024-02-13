<?php

namespace App\Http\Controllers;

use App\Models\ProjectExpert;
use Illuminate\Http\Request;

class ProjectInvitation extends Controller
{
    public function index($token){
        $project = ProjectExpert::where('token',$token)->first();
        if(!$project) return view('errors.404');
        $project_id = $project->project_id;
        // get expert email and name
        $expert = $project->expert()->first();
        $email = $expert->email;
        $name = $expert->name;

        return view('project_invitation',[
            'project' => $project,
            'email' => $email,
            'name' => $name,
            'token' => $token,
        ]);
    }
}
