<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Str;

class SocialLoginController extends Controller
{
    public function redirectToDriver($driver, $user_type, $timezone)
    {
        $timezone = Str::of($timezone)->replace('__', '/');
        session(['timezone' => $timezone]);
        return Socialite::driver($driver)->with(['state' => $user_type])->redirect();
    }

    public function handleCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (InvalidStateException $e) {
            $user = Socialite::driver($driver)->stateless()->user();
        }

        $user_type = request()->input('state');
        $email = $user->email;
        if (Str::contains($email, '@asiadealhub.com')) {
            return redirect()->route('login.index', ['type' => $user_type])->with('admin_error', 'This email is reserved for admin and you are not registered yet. Please ask Super Admin to register your credential into the system.');
        }
        $this->userDetails($user, $user_type, session()->get('timezone'));
        $this->updateUserAvatar($user, $driver);
        return redirect()->route($user_type == 'client' ? 'client.overview.index' : 'expert.overview.index');
    }

    public function updateUserAvatar($user, $provider){
        // if user exist update avatar
        $_user = User::where('email', $user->email)->first();
        if ($user) {
            if ($provider == 'google') {
                if ($_user->avatar_path == null) $_user->avatar_path = $user->avatar;
            } else if ($provider == 'linkedin-openid') {
                if ($_user->avatar_path == null) $_user->avatar_path = $user->avatar_original;
            }
            $_user->save();
        }
    }

    public function userDetails($socialite_data, $user_type, $timezone){
        // if there is user login then logut first
        if (auth()->user()) auth()->logout();
        $user = User::where('email', $socialite_data->email)->first();
        if (!$user) {
            // if user does not exist
            $user = new User();
            $user->status = 1;
            $user->name = $socialite_data->name;
            $user->email = $socialite_data->email;
            $user->email_verified_at = now();
            $user->timezone = $timezone;
            $user->save();
            $user->assignRole('user');
        }
        session(['user_type' => $user_type]);
        auth()->login($user, true);
    }
}
