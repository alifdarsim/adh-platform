<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ScrapeLinkendInJob;
use App\Models\ExpertImport;
use App\Models\ExpertList;
use App\Models\User;
use App\Services\LinkedInScrapeService;
use App\Services\ProcessScrapeService;
use Illuminate\Http\Request;

class ExpertImportController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) return $this->datatable();
        return view('admin.users.expert-import.index');
    }

    public function datatable(){
        $expertImports = ExpertImport::orderBy('id', 'desc')->get();
        return datatables()->of($expertImports)
            ->make(true);
    }

    public function store()
    {
        $isExist = ExpertImport::where('linkedin_url', request()->input('linkedin_url'))->exists();
        if ($isExist) return error('The LinkedIn URL has already been submitted.');
        $expertImport = ExpertImport::create([
            'linkedin_url' => request()->input('linkedin_url'),
            'status' => 'pending'
        ]);
        ScrapeLinkendInJob::dispatch($expertImport->id);
        return response()->json(['success' => true, 'message' => 'Expert import request has been submitted successfully.']);
    }

    public function destroy($id)
    {
        ExpertImport::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Expert import request has been deleted successfully.']);
    }

    public function reScrape($id)
    {
//        $test = ExpertImport::find($id)->result;
//        $test = json_encode($test);
//        $this->processed($test, ExpertImport::find($id)->linkedin_url, new ProcessScrapeService());
        $expertImport = ExpertImport::findOrFail($id);
        ScrapeLinkendInJob::dispatch($expertImport->id);
        return response()->json(['success' => true, 'message' => 'Expert import request has been submitted for scraping.']);
    }

    public function scrapeLinkedInData($linkedinUrl): string
    {
        $linkedin = new LinkedInScrapeService();
        return $linkedin->scrape($linkedinUrl);
    }
}
