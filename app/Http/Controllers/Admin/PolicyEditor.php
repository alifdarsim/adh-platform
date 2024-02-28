<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EditorPolicy;
use Illuminate\Http\Request;

class PolicyEditor extends Controller
{
    public function privacy()
    {
        $content = EditorPolicy::where('type', 'privacy-policy')->first()->content;
        return view('admin.policy.privacy', compact('content'));
    }

    public function terms_conditions()
    {
        $content = EditorPolicy::where('type', 'terms_conditions')->first()->content;
        return view('admin.policy.terms_conditions', compact('content'));
    }

    public function faq()
    {
        $content = EditorPolicy::where('type', 'faq')->first()->content;
        return view('admin.policy.faq', compact('content'));
    }


    public function update($type)
    {
        $this->validate(request(), [
            'content' => 'required',
        ]);
        $content = request('content');
        $policy =  EditorPolicy::where('type', $type)->first();
        //update the policy
        $policy->content = $content;
        $policy->save();
        return  success('Policy updated successfully');
    }
}
