<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpertList;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function data(){
        $projects = Projects::get();
        return [
            'count' => [
                'projects' => Projects::count(),
                'users' => User::count(),
                'experts' => ExpertList::count(),
                'client' => 0
            ],
            'projects' => Projects::orderBy('id', 'desc')
                ->limit(5)->get(),
            'users' => User::orderBy('id', 'desc')->limit(5)->get(),
            'hub' => [
                'partner' => $projects->where('hub_id', 1)->count(),
                'marketing' => $projects->where('hub_id', 2)->count(),
                'mna' => $projects->whereIn('hub_id', [3,4])->count(),
                'fund' => $projects->whereIn('hub_id', [5,6])->count(),
            ]
        ];
    }
}
