<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpertList;
use App\Models\ExpertLinkedInQueue;
use App\Services\LinkedInScrapeService;
use App\Services\ProcessScrapeService;
use GuzzleHttp\Exception\GuzzleException;

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
        $linkedin = new LinkedInScrapeService();
        $data_scrape = $linkedin->scrape($url);
        $result = $this->storeInfo($url, $data_scrape);
        if ($result) return success('Profile is successfully scrape');
        else return error('Something went wrong');
    }

    public function processed($id, ProcessScrapeService $scrapeProcess)
    {
        // check if info is expert info is already processed before
        $expert = ExpertLinkedInQueue::where('id', $id)->first();
        $expert_url = $expert->url;
        $result = $expert->result;
        $exist = ExpertList::where('url', $expert_url)->first();
        $process = $scrapeProcess->processInfo($result, $exist);
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
        $import_experts = ExpertLinkedInQueue::select(['id','url', 'status', 'processed', 'last_scrape', 'last_process'])->get();
        return datatables()->of($import_experts)->make();
    }

    public function storeInfo($url, $data){
        $_data = $data->data;
        $import = ExpertLinkedInQueue::where('url', $url)->first();
        $import->status = 1;
        $import->result = $_data;
        $import->last_scrape = now();
        $import->save();
        return $import;
    }
}
