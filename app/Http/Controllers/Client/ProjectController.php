<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Hub;
use App\Models\Keyword;
use App\Models\Projects;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Psr\Container\ContainerExceptionInterface;
use Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->client->projects;
        $projects = $projects->filter(function($project){
            return $project->createdBy->id == auth()->user()->id;
        });
        return view('client.project.index');
    }

    public function create()
    {
        $hubs = Hub::all();
        $company = auth()->user()->client->company;
        return view('client.project.create', compact('hubs', 'company'));
    }

    public function show($pid)
    {
        $project = Projects::where('pid', $pid)->first();
        if (!$project) return view('errors.not-exist');
        return view('client.project.show.index', compact('project'));
    }

    public function store(){
        if(!request()->company_id) return error('Company for this project is required');
        $questions = request()->get('target_question');
        // get not null questions
        $questions = array_filter($questions, function($question){
            return $question != null;
        });
        if (count($questions) < 1) return error('You need to ask at least one question to the expert');
        $project = Projects::create([
            'name' => request()->get('name'),
            'company_id' => request()->get('company_id'),
            'description' => request()->get('description'),
            'hub_id' => request()->get('hub'),
            'pid' => \Illuminate\Support\Str::replace('-', '', Str::uuid()),
            'budget' => request()->get('budget'),
            'status' => 'pending',
            'created_by' => auth()->user()->id,
            'deadline' => Carbon::createFromFormat('d/m/Y', request()->get('deadline'))->format('Y-m-d'),
            'questions' => $questions
        ]);
        $project->targetCountries()->sync(request()->get('target_country'));
        $project->projectTargetInfo()->create([
            'industry_id' => request()->get('target_industry'),
            'company_size' => request()->get('target_company_size'),
            'communication_language' => json_encode(request()->get('communication_language')),
        ]);
        foreach (request()->get('target_keyword') as $keyword) {
            $keyword = Keyword::firstOrCreate(['name' => $keyword]);
            $keywordIds[] = $keyword->id;
        }
        $project->keywords()->sync($keywordIds);
        return success('Project created successfully');
    }

    public function datatable()
    {
        $projects = auth()->user()->client->projects;
        // if created_by is not this user, then it is not his project
        $projects = $projects->filter(function($project){
            return $project->createdBy->id == auth()->user()->id;
        });
        return datatables()->of($projects)
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
                return $project->deadline;
            })
            ->addColumn('created_by', function ($project) {
                return $project->createdBy->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
