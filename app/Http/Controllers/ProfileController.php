<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function activity(){
        $user = auth()->user()->id;
        $auth_logs = User::find($user)->authentications()->limit(20)->get();
        foreach ($auth_logs as $log) {
            $log->created_at = Carbon::parse($log->created_at)->format('d M Y H:i:s');
            $agent = new Agent();
            $agent->setUserAgent($log->user_agent);
            $log->device = $agent->device();
            $log->platform = $agent->platform();
            $log->browser = $agent->browser();
        }
        return view('profile.activity', compact('auth_logs'));
    }

    public function social(){
        $socials = "";
        return view('profile.social', compact('socials'));
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
        return success('Profile updated successfully');
    }
}
