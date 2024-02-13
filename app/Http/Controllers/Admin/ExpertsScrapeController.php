<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\ExpertLinkedInQueue;
use App\Services\LinkedInScrapeService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Yajra\DataTables\Exceptions\Exception;

class ExpertsScrapeController extends Controller
{
    public function index()
    {
        return view('admin.experts-scrape.index');
    }

    /**
     * @throws GuzzleException
     */
    public function scrape($id){
        $data = ExpertLinkedInQueue::find($id);
        $url = $data->url;
        $linkedin = new LinkedInScrapeService('352d476f31msh822e80e319af0f4p14ee40jsn8bb495c30a26');
        $data_scrape = $linkedin->scrape($url);
        $result = $this->storeInfo($url, $data_scrape);
        if ($result) return success('Profile is successfully scrape');
        else return error('Something went wrong');
    }

    public function processed($id)
    {
        // check if info is expert info is already processed before
        $expert = ExpertLinkedInQueue::where('id', $id)->first();
        $expert_url = $expert->url;
        $result = $expert->result;
        $exist = Expert::where('url', $expert_url)->first();
        $process = $this->processInfo($result, $exist);
        if ($process) {
            ExpertLinkedInQueue::where('id', $id)->update([
                'processed' => 1,
                'expert_id' => $process->id,
            ]);
            return success('Profile is successfully processed');
        }
        else return error('Something went wrong');
    }

    public function store(){
        $url = request('url');
        if (!filter_var($url, FILTER_VALIDATE_URL)) return error('Invalid URL');
        ExpertLinkedInQueue::create([
            'url' => $url,
            'status' => 0,
        ]);
        return success('Profile is successfully added to the queue');
    }

    /**
     * @throws \Exception
     */
    public function datatable(){
        $import_experts = ExpertLinkedInQueue::select(['id','url', 'status', 'processed', 'last_fetch'])->get();
        return datatables()->of($import_experts)->make();
    }

    public function processInfo($info, $exist){
        // convert info to object
        $data = $info;
        $url = 'https://www.linkedin.com/in/' . $data->publicIdentifier;
        $name = $data->fullName;
        $about = $data->about ?? null;
        $img = $data->profilePic ?? null;
        $country = $data->addressCountryOnly ?? $data->addressWithoutCountry;
        $address = $data->addressWithoutCountry;
        $skills = collect($data->skills)->map(fn ($e) => $e->title)->toArray();
        $languages = collect($data->languages)->map(fn ($e) => $e->title)->toArray();
        $educations = collect($data->educations)->map(function ($e){
            return [
                'school' => $e->title ?? '',
                'degree' => $e->subtitle ?? '',
                'duration' => $e->caption ?? '',
            ];
        })->toArray();
        $experiences = [];
        collect($data->experiences)->each(function ($e) use (&$experiences){
            if ($e->breakdown) {
                $company = $e->title;
                collect($e->subComponents)->map(function ($e) use ($company, &$experiences){
                    $experiences[] = [
                        'company' => $company ?? '',
                        'position' => $e->title ?? '',
                        'location' => explode(" · ", $e->metadata ?? '')[0],
                        'duration' => explode(" · ", $e->caption ?? '')[0],
                    ];;
                });
            }
            else {
                $experiences[] = [
                    'company' => explode(" · ", $e->subtitle ?? '')[0],
                    'position' => $e->title ?? '',
                    'location' => explode(" · ", $e->metadata ?? '')[0],
                    'duration' => explode(" · ", $e->caption ?? '')[0],
                ];
            }
        });
        if ($exist) {
            $exist->update([
                'url' => $url,
                'name' => $name,
                'about' => $about,
                'img_url' => $img,
                'country' => $country,
                'address' => $address,
                'skills' => $skills,
                'languages' => $languages,
                'educations' => $educations,
                'experiences' => $experiences
            ]);
            return $exist;
        }
        else {
            return Expert::create([
                'url' => $url,
                'name' => $name,
                'about' => $about,
                'img_url' => $img,
                'country' => $country,
                'address' => $address,
                'skills' => $skills,
                'languages' => $languages,
                'educations' => $educations,
                'experiences' => $experiences
            ]);
        }
    }

    public function storeInfo($url, $data){
        $_data = $data->data->data;
        $import = ExpertLinkedInQueue::where('url', $url)->first();
        $import->status = 1;
        $import->result = $_data;
        $import->last_fetch = now();
        $import->save();
        return $import;
    }
}
