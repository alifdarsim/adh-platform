<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\ExpertList;
use App\Models\ProjectExpert;
use App\Services\ProfileCompletionService;
use Auth;

class OverviewController extends Controller
{
    public function index(ProfileCompletionService $service)
    {
        $data = $service->getCompletionData();
        $expert_completion = $data['completion'];
        $expert_completion_count = $data['count'];
        $expert_list = ExpertList::where('email', Auth::user()->email)->first();
        $project_expert = ProjectExpert::where('expert_id', $expert_list->id)->get();
        return view('expert.overview', compact('expert_completion', 'expert_completion_count', 'project_expert'));
    }
}
