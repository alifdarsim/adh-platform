<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EditorPolicy;
use Illuminate\Http\Request;

class TermsPolicyEditor extends Controller
{
    public function index()
    {
        $type = key(request()->query());
        if (\request()->ajax()) return $this->getDatatable($type);
        $types = key(request()->query()) === 'terms-conditions' ? 'Terms & Conditions' : 'Privacy Policy';
        return view('admin.terms-policy.index', compact('types'));
    }

    public function getDatatable($type)
    {
        $policies = EditorPolicy::where('type', $type)->get();
        return datatables($policies)
            ->make(true);
    }

    public function create()
    {
        $types = key(request()->query()) === 'terms-conditions' ? 'Terms & Conditions' : 'Privacy Policy';
        return view('admin.terms-policy.create', compact('types'));
    }

    public function edit($id)
    {
        $policy = EditorPolicy::find($id);
        if ($policy->type !== key(request()->query())) return redirect()->route('admin.terms-policy.index', key(request()->query()));
        $types = key(request()->query()) === 'terms-conditions' ? 'Terms & Conditions' : 'Privacy Policy';
        return view('admin.terms-policy.edit', compact('policy', 'types'));
    }

    public function store()
    {
        $this->validate(request(), [
            'content' => 'required',
            'type' => 'required',
            'language' => 'required',
        ]);
        EditorPolicy::create([
            'content' => request('content'),
            'type' => request('type'),
            'language' => request('language'),
        ]);
        return  success('Policy created successfully');
    }

    public function update($id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);
        $policy = EditorPolicy::find($id);
        $policy->content = request('content');
        $policy->save();
        return  success('Policy updated successfully');
    }

    public function destroy($id)
    {
        EditorPolicy::destroy($id);
        return success('Policy deleted successfully');
    }
}
