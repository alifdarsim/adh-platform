<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\MailSender;
use App\Models\Country;
use App\Models\User;
use App\Services\EmailConfirmationService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    /**
     * Show the application registration form.
     */
    public function index($type){
        $countries = Country::select(['emoji', 'phonecode', 'id', 'name', 'iso2'])->get();
        if ($type == 'client') return view('auth.register-client', compact('countries'));
        else return view('auth.register-expert', compact('countries'));
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(RegisterRequest $request, UserService $userService, MailSender $mailSender)
    {
        // validate password to be at least 6 characters
        if (strlen($request->password) < 6) return error('Password must be at least 6 characters');
        // check if register type is expert
        if ($request->user_type == 'expert') {
            // check if user with email already exists and is expert
            $user = User::where('email', $request->email)->where('role', 'expert')->first();
            if ($user) return error('Expert account with same email already exists');
        }
        else {
            // check if user with email already exists and is client
            $user = User::where('email', $request->email)->where('role', 'client')->first();
            if ($user) return error('Client account with same email already exists');
        }
        $token = md5(uniqid(rand(), true));
        // Create user
        $user = $userService->createUser($request->name, $request->email, $request->password, $request->timezone, $token, $request->phone, $request->phone_code, $request->referer_code);
        $userService->assignUserRole($user, $request->user_type);
        // Send email to user
        $mailSender->sendRegistrationEmail($request->email, $token);
        // Return response
        return success('Registration successful. Please confirm your email address to login');
    }

    /**
     * Confirm user email.
     */
    public function verify($token)
    {
        $user = User::where('token', $token)->where('token_expires_at', '>=', now())->first();
        if ($user) {
            $user->update(['token' => null, 'token_expires_at' => null, 'status' => 1]);
        }
        return view('auth.email-verified');
    }

    public function remove_account($token){
        $user = User::where('token',$token)->first();
        if($user){
            $user->delete();
            return success('Account deleted successfully');
        }
        return error('User not found');
    }
}
