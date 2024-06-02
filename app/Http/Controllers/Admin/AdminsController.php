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

    public function index()
    {
        if (\request()->ajax()) return $this->datatable();
        return view('admin.users.admins.index');
    }

    public function datatable()
    {
        // get all admin user using datatable query
        $users = User::whereIn('role', ['admin', 'member'])->get();
        return datatables()->of($users)
            ->addColumn('email', function ($user) {
                return $user->email;
            })
            ->addColumn('user_avatar', function ($user) {
                if ($user->avatar_path != null) return $user->avatar_path;
                return $user->user_avatar($user->name);
            })
            ->addColumn('last_login_at', function ($user) {
                return $user->lastLoginAt();
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.users.admins.create');
    }

    public function store(MailSender $mailSender)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:' . User::class],
            'terms' => ['required', 'accepted'],
        ]);
        $role = str_replace('_', ' ', request('role'));
        $token = Str::random(32);
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'token' => $token,
            'token_expires_at' => now()->addDays(3),
            'status' => 0,
        ]);
        //assignRole after creating user using Spatie
        $user->role = $role;
        $user->referer_code = $this->generateRandomString();
        $user->save();
        $mailSender->sendAdminInvitation(request('email'), request('name'), $token);
        return success('New Admin created successfully');
    }

    public function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return strtoupper($randomString);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->hasRole('super admin')) {
            // if there is still at least one super admin in the system, then we can not delete the super admin
            $superAdmins = $user->where('role', 'admin');
            if ($superAdmins->count() === 1) {
                return error('You can not delete the last super admin');
            }
        }
        $user->delete();
        return success('Admin deleted successfully');
    }

    // Admin Invitation

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
}
