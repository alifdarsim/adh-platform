<?php

namespace App\Http\Controllers;

use App\Models\ExpertList;
use App\Models\ExpertLinkedInQueue;
use App\Models\User;
use App\Services\LinkedInScrapeService;
use App\Services\ProcessScrapeService;
use App\Services\ProfileCompletionService;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class ExpertProfileController extends Controller
{
    public function index(ProfileCompletionService $service)
    {
        $data = $service->getCompletionData();
        $expert_completion = $data['completion'];
        $expert_completion_count = $data['count'];
        return view('expert.profile.index', compact('expert_completion', 'expert_completion_count'));
    }

    public function linkedin_sync(ProcessScrapeService $scrapeProcess)
    {
        $url = auth()->user()->expert->url;
        if ($url == null) return error('LinkedIn URL not set yet');
        $expert_list = ExpertList::where('url', $url)->first();
        $expert = auth()->user()->expert;
        if ($expert_list) {
            // update user expert_id to $expert_exist->id
            $expert->email = $expert_list->email;
            $expert->about = $expert_list->about;
            $expert->img_url = $expert_list->img_url;
            $expert->country = $expert_list->country;
            $expert->address = $expert_list->address;
            $expert->languages = $expert_list->languages;
            $expert->skills = $expert_list->skills;
            $expert->experiences = $expert_list->experiences;
            $expert->save();
            return success('LinkedIn URL added successfully', ['expert_exist' => true]);
        }
        else {
            $expert_queue = ExpertLinkedInQueue::create([
                'url' => $url,
            ]);
            $linkedin = new LinkedInScrapeService();
            $data_scrape = $linkedin->scrape($expert_queue->url);
            $data = $this->storeInfo($expert_queue->url, $data_scrape);
            if ($data) {
                $process = $scrapeProcess->processInfo($data->result, false);
                $expert_queue->update([
                    'processed' => 1,
                    'last_process' => now(),
                    'expert_id' => $process->id,
                ]);
                auth()->user()->expert_id = $process->id;
                auth()->user()->name = $process->name;
                auth()->user()->save();
                return success('LinkedIn URL added successfully', ['expert_exist' => false]);
            }
            else return error('Something went wrong');
        }
    }

    public function linkedin(Request $request)
    {
        $request->validate([
            'linkedin_url' => 'required|url',
        ]);
        if (str_ends_with($request->linkedin_url, '/')) {
            $request->linkedin_url = substr($request->linkedin_url, 0, -1);
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

    public function industry(Request $request)
    {
        $expert = auth()->user()->expert;
        $expert->industry_id = $request->industry_id;
        $expert->save();
        return success('Industry added successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string'
        ]);
        $user = auth()->user();
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->save();
        $expert = $user->expert;
        $expert->about = $request->about;
        $expert->save();
        return success('Profile updated successfully');
    }

    public function job_add(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'company' => 'required|string',
            'address' => 'required|string',
            'start_month' => 'required|string',
            'start_year' => 'required|string',
            'end_month' => 'required|string',
            'end_year' => 'required|string',
        ]);
        $expert = auth()->user()->expert;
        $position = $expert->position;
        $position[] = [
            'title' => $request->title,
            'companyName' => $request->company,
            'location' => $request->address,
            'description' => '', //TODO add description
            'employmentType' => '', //TODO add employment type
            'start' => [
                'day' => 0,
                'month' => Carbon::createFromFormat('M', $request->start_month)->month,
                'year' => (int)$request->start_year,
            ],
            'end' => [
                'day' => 0,
                'month' => Carbon::createFromFormat('M', $request->end_month)->month,
                'year' => (int)$request->end_year,
            ],
        ];

        // Define the comparison as a closure
        $comparePositions = function($a, $b) {
            $aStart = Carbon::createFromDate($a['start']['year'], $a['start']['month'], $a['start']['day']);
            $bStart = Carbon::createFromDate($b['start']['year'], $b['start']['month'], $b['start']['day']);

            if ($aStart->eq($bStart)) {
                return 0;
            }
            return $aStart->lt($bStart) ? 1 : -1;
        };
        usort($position, $comparePositions);
        $expert->position = $position;
        $expert->save();
        return success('Job experience added successfully');
    }
}
