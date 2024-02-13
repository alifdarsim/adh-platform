<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Str;

class SocialLoginController extends Controller
{
    public function redirectToDriver($driver, $user_type)
    {
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
        $this->updateUserAvatar($user, $driver);
        $this->userDetails($user);
        return redirect()->route($user_type == 'client' ? 'client.overview' : 'expert.overview');
    }

    public function updateUserAvatar($user, $provider){
        // if user exist update avatar
        $_user = User::where('email', $user->email)->first();
        if ($user) {
            if ($provider == 'google') {
                $_user->google_avatar = $user->avatar;
            } else if ($provider == 'linkedin') {
                $_user->linkedin_avatar = $user->avatar_original;
            }
            $_user->save();
        }
    }

    public function userDetails($user){
        // if there is user login then logut first
        if (auth()->user()) auth()->logout();
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            auth()->login($existingUser);
        } else {
            // if user does not exist
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->email_verified_at = now();
            $newUser->password = Hash::make(Str::random(24));
            $newUser->save();
            auth()->login($newUser, true);
        }
    }
}
