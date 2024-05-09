<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ExpertList;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Response;

class LoginController extends Controller
{
    public function index($type)
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin() || auth()->user()->isMember()) {
                return redirect()->route('admin.overview.index');
            }
            $route = $type == 'expert' ? 'expert.overview.index' : 'client.overview.index';
            dd($route);
//            return redirect()->route($route);
        }
        if ($type == 'expert') {
            return view('auth.login-expert');
        }
        return view('auth.login-client');
    }

    public function authenticate($type, Request $request)
    {
        return $this->extracted($type, $request);
    }

    public function logout($type)
    {
        auth()->logout();
        return redirect()->route('login.index', ['type' => $type]);
    }

    public function extracted($type, Request $request): JsonResponse
    {
        if (auth()->attempt($request->only('email', 'password'))) {
            // if user status is 0, return error
            if (auth()->user()->status == 0) {
                auth()->logout();
                return error('Verify Email', [
                    'text' => 'Please verify your email address to login',
                ]);
            }

            // check if user role is not equal to role
            if (auth()->user()->isAdmin() || auth()->user()->isMember()){
                session(['timezone' => $request->timezone, 'user_type' => 'admin']);
                return Response::json([
                    'success' => true,
                    'message' => 'Login successful',
                    'isadmin' => true,
                    'isSuperAdmin' => auth()->user()->isAdmin(),
                ]);
            }
            session(['timezone' => $request->timezone, 'user_type' => $request->type]);
            return success('Login successful');
        }
        if (User::where('email', $request->email)->first()) {
            return error('Invalid Password', [
                'text' => 'If you use social account to login previously, please use the same method to login. You can also reset your password',
            ]);
        }
        return error('Invalid Credential', [
            'text' => 'Make sure email and password are correct',
        ]);
    }
}
