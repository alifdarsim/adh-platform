<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;

class OverviewController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->name && $user->email && $user->phone && ($user->expert->about ?? null)) $personal_details = true;
        else $personal_details = false;
        if ($user->expert->url ?? null) $linkedin_url = true;
        else $linkedin_url = false;
        if ($user->expert->experiences ?? null) $job_experience = true;
        else $job_experience = false;
        if ($user->expert) {
            $cv = $user->expert->getMedia('cv');
            $upload_cv = $cv->isNotEmpty();
        } else {
            $upload_cv = false;
        }
        $assessment = ($user->assessment?->status ?? null) === 'complete';
        if ($user->expert->skills ?? null) $skills = true;
        else $skills = false;
        $expert_completion = [
            "linkedin" => [
                'text' => 'LinkedIn Sync',
                'status' => $linkedin_url,
            ],
            "personal" => [
                'text' => 'Personal Details',
                'status' => $personal_details,
            ],
            "experience" => [
                'text' => 'Job Experience',
                'status' => $job_experience,
            ],
            "cv" => [
                'text' => 'Upload CV',
                'status' => $upload_cv,
            ],
            "skills" => [
                'text' => 'Skills',
                'status' => $skills,
            ],
            "assessment" => [
                'text' => 'Assessment',
                'status' => $assessment,
            ]
        ];
        uasort($expert_completion, function ($a, $b) {
            return $b['status'] - $a['status'];
        });
        $expert_completion = json_decode(json_encode($expert_completion));
        $expert_completion_count = 0;
        foreach ($expert_completion as $completion) {
            if ($completion->status) $expert_completion_count++;
        }
        return view('expert.overview', [
            'expert_completion' => $expert_completion,
            'expert_completion_count' => $expert_completion_count,
        ]);
    }
}
