<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\ProjectExpert;

class ExpertsController extends Controller
{
    public function index()
    {
        return view('admin.experts.index');
    }

    public function destroy($id){
        $expert = Expert::find($id);
        $expert->delete();
        return redirect()->back()->with('success', 'Expert deleted successfully');
    }

    public function datatable(){
        $experts = Expert::get();
        return datatables()->of($experts)
            ->addColumn('company', function ($e) {
                return $e->experiences[0]['company'];
            })
            ->addColumn('companies', function ($e) {
                $pos = $e->experiences;
                $companies = [];
                foreach ($pos as $p){
                    $companies[] = $p['company'];
                }
                return implode(' ', $companies);
            })
            ->addColumn('position', function ($e) {
                return $e->experiences[0]['position'];
            })
            ->addColumn('positions', function ($e) {
                $pos = $e->experiences;
                $positions = [];
                foreach ($pos as $p){
                    $positions[] = $p['position'];
                }
                return implode(' ', $positions);
            })
            ->addColumn('skill_list', function ($e) {
                return implode(' ', $e->skills);
            })
            ->addColumn('country', function ($e) {
                return $e->country;
            })
            ->toJson();
    }

    public function set_contact(){
        $expert = Expert::find(request()->get('expert_id'));
        $expert->email = request()->get('email');
        $expert->save();
        return success('Contact updated successfully');
    }
}
