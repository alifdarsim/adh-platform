<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class AccountController extends Controller
{
    public function index()
    {
        return view('admin.account.index');
    }
    public function avatar()
    {
        $base64 = request()->input('avatar');
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
        $image_path = '/avatar/' . time() . '.png';
        file_put_contents(public_path() . $image_path, $image);
        $user = User::find(auth()->user()->id);
        $user->avatar_path = $image_path;
        $user->save();
        return success('Avatar updated successfully');
    }

    public function language()
    {
        $user = User::find(auth()->user()->id);
        $user->language = request()->input('language');
        $user->save();
        return success('Language updated successfully');
    }

    public function timezone()
    {
        $user = User::find(auth()->user()->id);
        $user->timezone = request()->input('timezone');
        $user->save();
        return success('Timezone updated successfully');
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
        return view('admin.account.activity', compact('auth_logs'));
    }

    public function show($tab)
    {
        if ($tab == 'security') return view('admin.account.security');
        else if ($tab == 'notification') return view('admin.account.notification');
        else if ($tab == 'activity') {
            return $this->activity();
        }
        else return $this->index();
    }

}
