<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Services\LinkedInScrapeService2;
use GuzzleHttp\Exception\GuzzleException;

class CompaniesController extends Controller
{
    private LinkedInScrapeService2 $linkedinService;

    public function __construct()
    {
        $this->linkedinService = new LinkedInScrapeService2();
    }

    public function index()
    {
        // count companies
        $count = Company::all()->count();
        return view('admin.companies.index',
            compact( 'count')
        );
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function show($id)
    {
        $company = Company::with('address', 'finance')->find($id);
        return view('admin.companies.show', compact('company'));
    }

    public function store()
    {
        // convert request()->get('company_image') from base64 to image
        $image_path = null;
        if (request()->get('company_image')) {
            $image = request()->get('company_image');
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'company_' . time() . '.png';
            \File::put(public_path() . '/images/' . $imageName, base64_decode($image));
            request()->merge(['company_image' => $imageName]);
            $image_path = '/images/' . $imageName;
        }

        // if company name already exists, return error
        if (Company::where('name', request()->get('name'))->first()) return error('Company name already created');
        $company = Company::create([
            'name' => request()->get('company_name'),
            'linkedin_vanity' => request()->get('linkedin_vanity'),
            'slogan' => request()->get('company_slogan'),
            'type_id' => request()->get('company_type'),
            'website' => request()->get('company_website'),
            'establish' => request()->get('company_establish'),
            'company_size' => request()->get('company_size'),
            'industry_id' => request()->get('sub_industry'),
            'about' => request()->get('about'),
            'img_url' => $image_path,
            'status' => session('user_type') == 'admin' ? 'active' : 'pending',
            'specialties' => request()->get('specialties_keywords'),
            'others' => request()->get('other_keywords'),
            'created_by' => auth()->user()->id
        ]);
        // create address
        $emoji = Country::where('name', request()->get('country'))->first()->emoji;
        $company->address()->create([
            'company_id' => $company->id,
            'address' => request()->get('address'),
            'postal' => request()->get('postal'),
            'city' => request()->get('city'),
            'state' => request()->get('state'),
            'country' => request()->get('country'),
            'emoji' => $emoji
        ]);
        // create finance data
        $company->finance()->create([
            'company_id' => $company->id,
            'revenue' => request()->get('revenue'),
            'operating_profit' => request()->get('profit'),
            'net_profit' => request()->get('net_profit'),
            'total_assets' => request()->get('total_assets'),
            'current_market_capital' => request()->get('current_market_capital'),
            'capital' => request()->get('capital'),
        ]);
        return success('Company created successfully');
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return success('Company deleted successfully');
    }

    public function datatable(){
        $companies = Company::with('type')->get();
        return datatables()->of($companies)
            ->addColumn('name', function ($company) {
                return $company->name;
            })
            ->addColumn('type', function ($company) {
                return $company->type == null ? '-' : $company->type->name;
            })
            ->addColumn('country', function ($company) {
                return $company->address->country;
            })
            ->addColumn('address', function ($company) {
                return json_decode($company->address);
            })
            ->addColumn('created_at', function ($company) {
                return $company->created_at->format('d M Y');
            })
            ->addColumn('updated_at', function ($company) {
                return $company->updated_at->format('d M Y');
            })
            ->addColumn('industry', function ($company) {
                return $company->industry == null ? '-' : $company->industry->name;
            })
            ->make(true);
    }

    /**
     * This method is used to prefill the company form with data from LinkedIn
     * @throws GuzzleException
     */
    public function prefill()
    {
        $vanity = request()->vanity;
        return $this->linkedinService->scrape($vanity);
    }
}
