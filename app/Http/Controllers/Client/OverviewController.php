<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->client->projects;
        $projects = $projects->filter(function($project){
            return $project->createdBy->id == auth()->user()->id;
        });
        return view('client.overview', compact('projects'));
    }
}
