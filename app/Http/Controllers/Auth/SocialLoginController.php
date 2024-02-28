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
        $this->userDetails($user, $user_type, session()->get('timezone'));
        $this->updateUserAvatar($user, $driver);
        return redirect()->route($user_type == 'client' ? 'client.overview' : 'expert.overview');
    }

    public function updateUserAvatar($user, $provider){
        // if user exist update avatar
        $_user = User::where('email', $user->email)->first();
        if ($user) {
            if ($provider == 'google') {
                $_user->google_avatar = $user->avatar;
            } else if ($provider == 'linkedin-openid') {
                $_user->linkedin_avatar = $user->avatar_original;
            }
            $_user->save();
        }
    }

    public function userDetails($socialite_data, $user_type, $timezone){
        // if there is user login then logut first
        if (auth()->user()) auth()->logout();
        $user = User::where('email', $socialite_data->email)->first();
        if ($user) {
            // add to session user type
            session(['user_type' => $user_type]);
            auth()->login($user);
        } else {
            // if user does not exist
            $newUser = new User();
            $newUser->status = 1;
            $newUser->name = $socialite_data->name;
            $newUser->email = $socialite_data->email;
            $newUser->email_verified_at = now();
            $newUser->timezone = $timezone;
            $newUser->save();
            //set user role to 'user'
            $newUser->assignRole('user');
            auth()->login($newUser, true);
        }
    }
}
