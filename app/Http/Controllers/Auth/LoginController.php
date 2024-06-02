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
            return redirect()->route($route);
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
        // Get the user by email
        $users = User::where('email', $request->email);

        // Check if the user exists
        if (!$users) return error('Invalid Credential', [
            'text' => 'Make sure email and password are correct',
        ]);

        // login the admin user
        if ($users->first()->isAdmin() || $users->first()->isMember()) {
            if (auth()->attempt($request->only('email', 'password'))) {
                session(['timezone' => $request->timezone, 'user_type' => 'admin']);
                return Response::json([
                    'success' => true,
                    'message' => 'Login successful',
                    'isadmin' => true,
                    'isSuperAdmin' => auth()->user()->isAdmin(),
                ]);
            }
            return error('Invalid Credential', [
                'text' => 'Make sure email and password are correct',
            ]);
        }

        // if users is not admin, check if user is expert or client
        $user = $users->where('role', $type)->get()->first();
        if (!$user) return error('Invalid Credential', [
            'text' => 'Not registered as ' . $type,
        ]);

        // check if user status is 0
        if ($user->status == 0) {
            return error('Verify Email', [
                'text' => 'Please verify your email address to login',
            ]);
        }

        // Login the user
        Auth::login($user);
        session(['timezone' => $request->timezone, 'user_type' => $type]);
        return success('Login successful');
    }
}
