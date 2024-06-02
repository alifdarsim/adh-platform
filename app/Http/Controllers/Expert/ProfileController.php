<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Jobs\ScrapeLinkendInJob;
use App\Models\ExpertImport;
use App\Models\ExpertList;
use App\Models\IndustryExpert;
use App\Services\LinkedInScrapeService;
use App\Services\ProcessScrapeService;
use App\Services\ProfileCompletionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class ProfileController extends Controller
{
    public function index(ProfileCompletionService $service)
    {
        $data = $service->getCompletionData();
        $expert = auth()->user()->expert;
        $show_complete_profile = true;
        if ($expert != null){
            $expert->email = $expert->email ?? auth()->user()->email;
            $expert->url = ExpertList::where('email', $expert->email)->first()->url ?? $expert->url;
            $expert->save();
            $expert_completion = $data['completion'];
            $expert_completion_count = $data['count'];
            // explicitly determine 4 item need to be completed to hide the warning dialog
            if ($expert_completion_count > 3) $show_complete_profile = false;
            return view('expert.profile.index', compact('expert_completion', 'expert_completion_count'))->with('show_complete_profile', $show_complete_profile);
        }
        else {
            $expert_completion = $data['completion'];
            $expert_completion_count = $data['count'];
            return view('expert.profile.index', compact('expert_completion', 'expert_completion_count'))->with('show_complete_profile', true);
        }
    }

    public function linkedin_sync(ProcessScrapeService $scrapeProcess)
    {
        $url = auth()->user()->expert->url;
        if ($url == null) return error('LinkedIn URL not set yet');
        $expert_import = ExpertImport::where('linkedin_url', $url)->first();
        $expert = auth()->user()->expert;
        if ($expert_import) {
            // update user expert_id to $expert_exist->id
            $expert->email = $expert_import->email;
            $expert->about = $expert_import->about;
            $expert->img_url = $expert_import->img_url;
            $expert->country = $expert_import->country;
            $expert->address = $expert_import->address;
            $expert->languages = $expert_import->languages;
            $expert->skills = $expert_import->skills;
            $expert->industry_main = $expert_import->industry_main;
            $expert->industry_sub = $expert_import->industry_sub;
            $expert->experiences = $expert_import->experiences;
            $expert->save();
            return success('LinkedIn URL added successfully', ['expert_exist' => true]);
        }
        else {
            $expert_import = ExpertImport::create([
                'email' => auth()->user()->email,
                'linkedin_url' => $url,
            ]);
            $expert_import->save();
            $this->scrapeLinkedIn($expert_import->id);
//            $linkedin = new LinkedInScrapeService();
//            $data_scrape = $linkedin->scrape($expert_queue->url);
//            $data = $this->storeInfo($expert_queue->url, $data_scrape);
//            if ($data) {
//                $process = $scrapeProcess->processInfo($data->result, false);
//                $expert_queue->update([
//                    'processed' => 1,
//                    'last_process' => now(),
//                    'expert_id' => $process->id,
//                ]);
//                auth()->user()->expert_id = $process->id;
//                auth()->user()->name = $process->name;
//                auth()->user()->save();
//                return success('LinkedIn URL added successfully', ['expert_exist' => false]);
//            }
//            else return error('Something went wrong');
        }
    }

    public function scrapeLinkedIn($id)
    {
        $expertImport = ExpertImport::findOrFail($id);
        $job = new ScrapeLinkendInJob($expertImport->id);

        // Wait for the job to complete
//        $job->onConnection('redis')->onQueue('scraping')->wait();

        // Notify the user when the job is done
        Event::listen('job-completed', function ($payload) use ($expertImport) {
            // Optional: Perform additional actions after the job is completed
            // ...

            // Notify the user
            return response()->json([
                'success' => true,
                'message' => 'Expert import request has been completed for ID: ' . $expertImport->id,
            ]);
        });

        // Dispatch the job
        dispatch($job);

        // Return a response while waiting for the job to complete
        return response()->json([
            'success' => true,
            'message' => 'Expert import request has been submitted for scraping. Please wait...',
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
        $industry = IndustryExpert::find($request->industry_id);
        $expert->industry_main = $industry->main;
        $expert->industry_sub = $industry->sub;
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

    public function jobRemove(Request $request)
    {
        $title = $request->title;
        $company = $request->company;
        $expert = auth()->user()->expert;
        $position = $expert->position;
        $index = -1; // Initialize the index to -1, indicating no match found initially
        foreach ($position as $key => $value) {
            if ($value['title'] === $title && $value['companyName'] === $company) {
                $index = $key; // Set the index to the current position if a match is found
                break; // Exit the loop since we found a match
            }
        }
        if ($index === -1) {
            return error('Job experience not found. Something is wrong, please try again');
        }
        array_splice($position, $index, 1);
        $expert->position = $position;
        $expert->save();
        return success('Job experience removed successfully');
    }

}
