<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class ExpertProfileController extends Controller
{
    public function index()
    {
        return view('expert.profile.index');
    }

    public function security()
    {
        return view('expert.profile.security');
    }

    public function notification()
    {
        return view('expert.profile.notification');
    }

    public function activity()
    {
        $auth_logs = User::find(auth()->user()->id)->authentications()->limit(20)->get();
        foreach ($auth_logs as $log) {
            $log->timestamp = Carbon::parse($log->login_at)->format('d M Y H:i:s');
            $agent = new Agent();
            $agent->setUserAgent($log->user_agent);
            $log->device = $agent->device();
            $log->platform = $agent->platform();
            $log->browser = $agent->browser();
        }
        return view('expert.profile.activity', compact('auth_logs'));

    }

    public function social()
    {
        return view('expert.profile.social');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = auth()->user();
        $user->addMediaFromRequest('image')->toMediaCollection('profile_images');
        // add thumbnail to media
        return success('Profile image uploaded successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
    }
}
