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
            ->addColumn('industry_classification', function ($expertImport) {
                return $expertImport->industry_main . ' - ' . $expertImport->industry_sub;
            })
            ->addColumn('verified', function ($expertImport) {
                $user = User::where('email', $expertImport->email)->first();
                return (bool)$user;
            })
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
        $expertImport = ExpertImport::findOrFail($id);
        ScrapeLinkendInJob::dispatch($expertImport->id);
        return response()->json(['success' => true, 'message' => 'Expert import request has been submitted for scraping.']);
    }

    public function setEmail($id)
    {
        $expertImport = ExpertImport::findOrFail($id);
        $expertImport->email = request()->input('email');
        $expertImport->save();
        if (ExpertList::where('email', $expertImport->email)->exists()) return error('The email has already been used by another expert.');
        $linkedinUrl = $expertImport->linkedin_url;
        if (str_ends_with($linkedinUrl, '/')) $linkedinUrl = substr($linkedinUrl, 0, -1);
        $expertList = ExpertList::where('url', $linkedinUrl)->first();
        if ($expertList) {
            $expertList->email = $expertImport->email;
            $expertList->save();
        }
        return response()->json(['success' => true, 'message' => 'Expert email has been set successfully.']);
    }

    public function setIndustryClassification($id)
    {
        $expertImport = ExpertImport::findOrFail($id);
        $expertImport->industry_main = request()->input('main');
        $expertImport->industry_sub = request()->input('sub');
        $expertImport->save();
        return response()->json(['success' => true, 'message' => 'Expert industry classification has been set successfully.']);
    }


    public function scrapeLinkedInData($linkedinUrl): string
    {
        $linkedin = new LinkedInScrapeService();
        return $linkedin->scrape($linkedinUrl);
    }
}
