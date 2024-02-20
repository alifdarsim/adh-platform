<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminInvitation;
use App\Mail\MailSender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;
use Yajra\DataTables\Exceptions\Exception;

class AdminsController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $adminsCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'super admin')->orWhere('name', 'admin');
        })->count();
        return view('admin.admins.index', compact('adminsCount'));
    }

    /**
     * Show the datatable data of admin user.
     * @throws Exception
     * @throws \Exception
     */
    public function datatable()
    {
        // get all admin user using datatable query
        $users = User::with('roles')->get()->filter(function ($user) {
            if ($user->hasRole('admin') || $user->hasRole('super admin') || $user->hasRole('editor')) {
                return $user;
            }
            return null;
        });
        return datatables()->of($users)
            ->addColumn('role', function ($user) {
                return $user->roles->first()->name;
            })
            ->addColumn('email', function ($user) {
                return $user->email;
            })
            ->addColumn('user_avatar', function ($user) {
                return $user->user_avatar();
            })
            ->addColumn('last_login_at', function ($user) {
                return $user->last_login_at;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new admin user.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created admin user in storage.
     */
    public function store(MailSender $mailSender)
    {

        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:' . User::class],
            'terms' => ['required', 'accepted'],
        ]);

        $token = Str::random(32);
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'token' => $token,
            'token_expires_at' => now()->addDays(3),
            'status' => 0,
        ]);
        //assignRole after creating user using Spatie
        $user->assignRole('admin');
        $mailSender->sendAdminInvitation(request('email'), request('name'), $token);
        return success('New Admin created successfully');
    }

    public function invitation($token)
    {
        $user = User::where('token', $token)->where('token_expires_at', '>=', now())->first();
        if ($user) {
            return view('auth.invite', compact('user'));
        } else {
            return view('errors.504');
        }
    }

    public function invitationPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $token = $request->token;
        $user = User::where('token', $token)->where('token_expires_at', '>=', now())->first();
        if ($user) {
            $user->update(['password' => Hash::make($request->password), 'token' => null, 'token_expires_at' => null, 'status' => 1]);
            return success('Password updated successfully. Redirecting to login page...');
        } else {
            return error('Invitation link expired');
        }
    }

    public function destroy()
    {
        $user = User::find(request('id'));
         if ($user->hasRole('super admin')) {
             return error('You can not delete super admin');
         }
        $user->delete();
        return success('Admin deleted successfully');
    }
}
