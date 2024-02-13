<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Response;

class LoginController extends Controller
{
    public function index($type)
    {
        return view('auth.login', compact('type'));
    }

    public function authenticate(Request $request)
    {
        return $this->extracted($request);
    }

    public function logout($type)
    {
        auth()->logout();
        return redirect()->route('login', ['type' => $type]);
    }

    public function extracted(Request $request): JsonResponse
    {
        if (auth()->attempt($request->only('email', 'password'))) {
            // check if user role is not equal to role
            $role = auth()->user()->getRoleNames();
            if ($role[0] == 'admin' || $role[0] == 'super admin'){
                session(['timezone' => $request->timezone, 'user_type' => 'admin']);
                return Response::json([
                    'success' => true,
                    'message' => 'Login successful',
                    'isadmin' => true
                ]);
            }
            // check if user has expert profile
//            $expert = auth()->user()->expert;
//            if (!$expert){
//                $expert = Expert::where('email', $request->email)->first();
//                if ($expert){
//                    $expert->user_id = auth()->user()->id;
//                    $expert->save();
//                    if (!auth()->user()->name){
//                        auth()->user()->name = $expert->name;
//                        auth()->user()->save();
//                    }
//                }
//            }
            session(['timezone' => $request->timezone, 'user_type' => $request->type]);
            return success('Login successful');
        }
        return error('Invalid credential');
    }
}
