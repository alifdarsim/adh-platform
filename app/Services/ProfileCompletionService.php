<?php

namespace App\Services;

use App\Models\Log;

class ProfileCompletionService
{
    public function getCompletionData(): array
    {
        $user = auth()->user();
        if ($user->name && $user->email && $user->phone && ($user->expert->about ?? null)) $personal_details = true;
        else $personal_details = false;
        if ($user->expert->url ?? null) $linkedin_url = true;
        else $linkedin_url = false;
        if ($user->expert->experiences ?? null) $job_experience = true;
        else $job_experience = false;
        $upload_cv = $user->expert->getMedia('cv')->isNotEmpty();

        $industry = true;
        $user->expert->industry_id ?? $industry = false;

        // if $user->assessment not null and status is complete then $assessment = true else $assessment = false
        if ($user->assessment ?? null) {
            if ($user->assessment->status == 'complete') $assessment = true;
            else $assessment = false;
        }
        else $assessment = false;

        if ($user->expert->skills ?? null) $skills = true;
        else $skills = false;

        $expert_completion = [
            "linkedin" => [
                'text' => 'LinkedIn Sync',
                'short' => 'LinkedIn',
                'tab' => 'linkedin',
                'status' => $linkedin_url,
            ],
            "personal" => [
                'text' => 'Personal Details',
                'short' => 'Personal',
                'tab' => 'personal',
                'status' => $personal_details,
            ],
            "experience" => [
                'text' => 'Job Experience',
                'short' => 'Experience',
                'tab' => 'experience',
                'status' => $job_experience,
            ],
            "industry" => [
                'text' => 'Industry Classification',
                'short' => 'Industry',
                'tab' => 'industry',
                'status' => $industry,
            ],
            "cv" => [
                'text' => 'Upload CV',
                'short' => 'CV/Resume',
                'tab' => 'cv',
                'status' => $upload_cv,
            ],
            "skills" => [
                'text' => 'Skills',
                'short' => 'Skills',
                'tab' => 'skills',
                'status' => $skills,
            ],
            "assessment" => [
                'text' => 'Assessment',
                'short' => 'Assessment',
                'tab' => 'assessment',
                'status' => $assessment,
            ]
        ];
        $expert_completion = json_decode(json_encode($expert_completion));
        $expert_completion_count = 0;
        foreach ($expert_completion as $completion) {
            if ($completion->status) $expert_completion_count++;
        }
        return [
            'completion' => $expert_completion,
            'count' => $expert_completion_count
        ];
    }
}
