<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Services\ProfileCompletionService;

class OverviewController extends Controller
{
    public function index(ProfileCompletionService $service)
    {
        $data = $service->getCompletionData();
        $expert_completion = $data['completion'];
        $expert_completion_count = $data['count'];
        return view('expert.overview', compact('expert_completion', 'expert_completion_count'));
    }
}
