<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Industry;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ExpertCompletionController extends Controller
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

        //get the cv from spatie media library
        if ($user->expert) {
            $cv = $user->expert->getMedia('cv');
            $upload_cv = $cv->isNotEmpty();
        } else {
            $upload_cv = false;
        }

        // check if user has taken the assessment
        $assessment = ($user->assessment?->status ?? null) === 'complete';

        // check if user has added skills
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
        // sort the array by status true first
        uasort($expert_completion, function ($a, $b) {
            return $b['status'] - $a['status'];
        });

        $expert_completion = json_decode(json_encode($expert_completion));

        $expert_completion_count = 0;
        foreach ($expert_completion as $completion) {
            if ($completion->status) $expert_completion_count++;
        }

        return view('expert.expert.profile-completion', [
            'expert_completion' => $expert_completion,
            'expert_completion_count' => $expert_completion_count
        ]);
    }

    public function linkedin(Request $request)
    {
        $request->validate([
            'linkedin_url' => 'required|url',
        ]);
        if (str_ends_with($request->linkedin_url, '/')) {
            $request->linkedin_url = substr($request->linkedin_url, 0, -1);
        }
        $expert_exist = Expert::where('url', $request->linkedin_url)->first();
        if ($expert_exist) {
            // update user expert_id to $expert_exist->id
            auth()->user()->expert_id = $expert_exist->id;
            auth()->user()->save();
            return success('LinkedIn URL added successfully', ['expert_exist' => true]);
        }
        $expert = auth()->user()->expert;
        $expert->url = $request->linkedin_url;
        $expert->save();
        return success('LinkedIn URL added successfully');
    }

    public function cv(Request $request)
    {
        $request->validate([
            'upload_cv' => 'required|mimes:pdf,doc,docx|max:3048',
        ]);
        $expert = auth()->user()->expert;
        $expert->addMediaFromRequest('upload_cv')->toMediaCollection('cv');
        $expert->save();
        return success('CV uploaded successfully');
    }

    public function skills(Request $request)
    {
        $request->validate([
            'skills' => 'required|string',
        ]);
        $expert = auth()->user()->expert;
        $skills = json_decode($request->skills);
        $modifiedSkills = [];
        foreach ($skills as $skill) {
            if (isset($skill->value)) {
                $modifiedSkills[] = ['name' => $skill->value];
            }
        }
        $expert->skills = $modifiedSkills;
        $expert->save();
        return success('Skills added successfully');
    }
}
