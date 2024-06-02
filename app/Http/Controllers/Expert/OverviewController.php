<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\ExpertImport;
use App\Models\ExpertList;
use App\Models\ProjectExpert;
use App\Services\ProfileCompletionService;
use Auth;
use Str;

class OverviewController extends Controller
{
    public function index(ProfileCompletionService $service)
    {
        $this->GenerateExpertData();
        $data = $service->getCompletionData();
        $expert_completion = $data['completion'];
        $expert_completion_count = $data['count'];
        $project_expert = auth()->user()?->expert?->id
            ? ProjectExpert::where('expert_id', auth()->user()->expert->id)->get()
            : collect();
        return view('expert.overview', compact('expert_completion', 'expert_completion_count', 'project_expert'));
//        return view('expert.overview', compact('expert_completion', 'expert_completion_count'));
    }

    public function GenerateExpertData()
    {
        // if expert not exist in expert_list, then create new expert
        $expert_exist = ExpertList::where('email', auth()->user()->email)->first();
        if (!$expert_exist) {
            $expert = new ExpertList();
            $expert->email = auth()->user()->email;
            $expert->save();
        }

//        $expert_imported = ExpertImport::where('email', auth()->user()->email)->first();
//        if ($expert_imported) {
//            $linkedin_url = $expert_imported->linkedin_url;
//            $expert_exist = ExpertList::where('email', $expert_imported->email)->first();
//            if ($expert_exist) {
//                if (Str::endsWith($linkedin_url, '/')) $linkedin_url = substr($linkedin_url, 0, -1);
//                $expert = ExpertList::where('url', $linkedin_url)->first();
//                if ($expert) {
//                    $expert->email = $expert_imported->email;
//                    $expert->save();
//                    ExpertList::where('email', $expert_imported->email)->first();
//                }
//            }
//        }
    }
}
