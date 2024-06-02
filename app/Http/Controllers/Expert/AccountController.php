<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class AccountController extends Controller
{

    public function index()
    {
        return view('expert.account.index');
    }

    public function avatar()
    {
        $base64 = request()->input('avatar');
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
        $image_path = '/avatar/' . time() . '.png';
        if (!file_exists(public_path() . '/avatar')) {
            mkdir(public_path() . '/avatar', 0777, true);
        }
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

    public function phone()
    {
        $user = User::find(auth()->user()->id);
        $user->phone = request()->input('phone');
        $user->phone_code = request()->input('phone_code');
        $user->save();
        return success('Phone updated successfully');
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
        return view('expert.account.activity', compact('auth_logs'));
    }

    public function show($tab)
    {
        if ($tab == 'security') return view('expert.account.security');
        else if ($tab == 'notification') return view('expert.account.notification');
        else if ($tab == 'activity') {
            return $this->activity();
        }
        else return $this->index();
    }


    public function payment()
    {
        return view('expert.account.payment');
    }

    public function update_payment()
    {
        $user = User::find(auth()->user()->id);
        $info = request()->input('payment_info');
        $bank = $info['bank_name'];
        $account = $info['bank_account'];
        $user->payment_info = [
            "method" => request()->input('method'),
            "bank" => $bank,
            "account" => $account
        ];
        $user->save();
        return success('Payment status updated successfully');
    }

}
