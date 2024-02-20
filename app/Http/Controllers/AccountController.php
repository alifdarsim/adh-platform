<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Password;

class AccountController extends Controller
{

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
        return view('expert.account.activity', compact('auth_logs'));
    }

    public function index()
    {
        return view('expert.account.index');
    }

    public function security()
    {
        return view('expert.account.security');
    }

    public function notification()
    {
        return view('expert.account.notification');
    }
}
