<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\MailSender;
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
    public function index(){
        if (auth()->check()) return redirect()->route('overview');
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(RegisterRequest $request, UserService $userService, MailSender $mailSender)
    {
        // validate password to be at least 6 characters
        if (strlen($request->password) < 6) return error('Password must be at least 6 characters');
        $token = md5(uniqid(rand(), true));
        // Create user
        $user = $userService->createUser($request->name, $request->email, $request->password, $request->timezone, $token);
        $userService->assignUserRole($user);
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
