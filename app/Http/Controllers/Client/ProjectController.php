<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Hub;
use App\Models\Projects;
use Carbon\Carbon;
use Str;

class ProjectController extends Controller
{
    public function index()
    {
        return view('client.project.index');
    }

    public function create()
    {
        $hubs = Hub::all();
        return view('client.project.create', compact('hubs'));
    }

    public function store()
    {
        $project = Projects::create([
            'pid' => Str::replace('-', '', Str::uuid()),
            'name' => request()->get('name'),
            'company_id' => request()->get('company_id'),
            'description' => request()->get('description'),
            'hub_id' => request()->get('hub'),
            'budget' => request()->get('hub'),
            'status' => 'pending',
            'user_id' => auth()->user()->id,
            'deadline' => Carbon::createFromFormat('d/m/Y', request()->get('deadline'))->format('Y-m-d'),
//            'target_expectation' => request()->get('target_expectation'),
//            'target_industry' => request()->get('target_industry'),
//            'target_company_size' => request()->get('target_company_size'),
//            'target_services_tag' => request()->get('target_services_tag'),
//            'target_others_tag' => request()->get('target_others_tag'),
//            'communication_language' => request()->get('communication_language'),
//            'target_revenue_from' => request()->get('target_revenue_from'),
//            'target_revenue_to' => request()->get('target_revenue_to'),
        ]);
        $project->targetCountries()->sync(request()->get('target_country'));
        return success('Project created successfully');
    }

    public function datatable()
    {
        $project = Projects::with('company')->where('user_id', auth()->user()->id)->get();
        return datatables()->of($project)
            ->addColumn('action', function ($project) {
                return '<a href="' . route('admin.projects.edit', $project->id) . '" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->addColumn('name', function ($project) {
                return $project->name;
            })
            ->addColumn('company', function ($project) {
                return $project->company->name;
            })
            ->addColumn('target_countries', function ($project) {
                return json_decode($project->targetCountries);
            })
            ->addColumn('company_img', function ($project) {
                return $project->company->img_url;
            })
            ->addColumn('hub', function ($project) {
                return $project->hub->name;
            })
            ->addColumn('description', function ($project) {
                return $project->description;
            })
            ->addColumn('deadline', function ($project) {
                return formatDate($project->deadline);
            })
            ->addColumn('created_by', function ($project) {
                return $project->user->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
