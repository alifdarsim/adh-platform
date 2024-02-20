<?php

namespace App\Http\Controllers;

use App\Mail\MailSender;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function index()
    {
        return view('auth.reset');
    }

    public function reset($token)
    {
        $email = PasswordReset::where('token', $token)->first();
        if (!$email) {
            return view('errors.not-exist');
        }
        return view('auth.reset_password', compact('email'));
    }

    public function update()
    {
        $email = PasswordReset::where('token', request('token'))->first()->email;
        if (!$email) {
            return error('Invalid token');
        }
        $password = request('password');
        $password_confirmation = request('password_confirmation');

        if ($password != $password_confirmation) {
            return back()->with('error', 'Password and Confirm Password does not match');
        }

        $user = User::where('email', $email)->first();
        $user->password = bcrypt($password);
        $user->save();

        PasswordReset::where('token', request('token'))->delete();

        return success('Password reset successfully');
    }



    public function password_reset($email, MailSender $mailSender)
    {
        PasswordReset::where('email', $email)->delete();
        $token = \Str::uuid();
        PasswordReset::create([
            'email' => $email,
            'token' => $token
        ]);
        $mailSender->sendPasswordReset($email, $token);
        return success('We have sent you an email with password reset link. Please check your email.');
    }
}
