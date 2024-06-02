<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpertList;
use App\Models\IndustryExpert;
use App\Models\Projects;
use App\Models\ProjectExpert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExpertsController extends Controller
{
    public function index()
    {
        return view('admin.experts.index');
    }

    public function destroy($id){
        $expert = ExpertList::find($id);
        $expert->delete();
        return redirect()->back()->with('success', 'Expert deleted successfully');
    }

    public function datatable(){
        $experts = ExpertList::with('industry')->orderBy('id', 'desc')->get();
        // Preload shortlisted expert IDs for the given project
        $projectShortlistIds = $this->getProjectShortlistedIds(request()->get('project_id'));
        return datatables()->of($experts)
            ->addColumn('company', function ($e) {
                return $e->experiences[0]['company'] ?? 'Not Set';
            })
            ->addColumn('companies', function ($e) {
                $pos = $e->experiences ?? [];
                $companies = [];
                foreach ($pos as $p){
                    $companies[] = $p['company'];
                }
                return implode(' ', $companies);
            })
            ->addColumn('registered', function ($e) {
                $email = $e->email == null ? 'Not Set' : $e->email;
                $user = User::where('email', $email)->first();
                return (bool)$user;
            })
            ->addColumn('position', function ($e) {
                return $e->experiences[0]['position'] ?? 'Not Set';
            })
            ->addColumn('positions', function ($e) {
                $pos = $e->experiences ?? [];
                $positions = [];
                foreach ($pos as $p){
                    $positions[] = $p['position'];
                }
                return implode(' ', $positions);
            })
            ->addColumn('skill_list', function ($e) {
                $e->skills = $e->skills ?? [];
                return implode(' ', $e->skills);
            })
            ->addColumn('country', function ($e) {
                return $e->country == null ? 'Not Set' : $e->country;
            })
            ->addColumn('main_industry', function ($e) {
                return $e->industry == null ? '' : $e->industry->main;
            })
            ->addColumn('sub_industry', function ($e) {
                return $e->industry == null ? '' : $e->industry->sub;
            })
            ->addColumn('industry_classification', function ($e) {
                return $e->industry == null ? 'Not Set' : $e->industry->main . ' - ' . $e->industry->sub;
            })
            ->addColumn('_email', function ($e) {
                return $e->email == null ? 'Not Set' : $e->email;
            })
            ->addColumn('_phone', function ($e) {
                return $e->phone == null ? 'Not Set' : $e->phone;
            })
            ->addColumn('shortlisted', function ($e) use ($projectShortlistIds) {
                return in_array($e->id, $projectShortlistIds);
            })
            ->rawColumns(['industry_classification'])
            ->toJson();
    }

    public function getProjectShortlistedIds($project_id) {
        $project = Projects::where('pid', $project_id)->first();
        if (!$project) {
            return [];
        }
        return ProjectExpert::where('project_id', $project->id)->pluck('expert_id')->toArray();
    }

    public function set_contact(){
        $expert = ExpertList::find(request()->get('expert_id'));
        if (request()->get('phone') != null) {
            $expert->phone = request()->get('phone');
        }
        if (request()->get('email') != null) {
            $expert->email = request()->get('email');
        }
        $expert->save();
        return success('Contact updated successfully');
    }

    public function industry(Request $request)
    {
        $expert = ExpertList::find($request->expert_id);
        $industry_value = $request->industry_val;
        $industry_id = IndustryExpert::where('sub', $industry_value)->first()->id;
        $expert->industry_id = $industry_id;
        $expert->save();
        return success('Industry update successfully');
    }
}
