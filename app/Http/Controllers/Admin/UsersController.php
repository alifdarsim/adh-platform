<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminInvitation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;
use Str;
use Yajra\DataTables\Exceptions\Exception;

class UsersController extends Controller
{
    /**
     * Show the users' dashboard.
     */
    public function index()
    {
        $usersCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->count();
        return view('admin.users.index', compact('usersCount'));
    }

    /**
     * Show the datatable data of admin user.
     * @throws Exception
     * @throws \Exception
     */
    public function datatable()
    {
        // get all user with role user using datatable query
        $users = User::with(['roles'])->get()->filter(function ($user) {
            if ($user->hasRole('user')) {
                return $user;
            }
            return null;
        });
        foreach ($users as $user) {
            $user->last_login_at = formatDateTime($user->lastLoginAt());
        }
        return datatables()->of($users)
            ->addColumn('action', function ($user) {
                return '<a href="' . route('admin.admins.edit', $user->id) . '" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->addColumn('role', function ($user) {
                return $user->roles->first()->name;
            })
            ->addColumn('email', function ($user) {
                return $user->email;
            })
            ->addColumn('name', function ($user) {
                return $user->name;
            })
            ->addColumn('last_login_at', function ($user) {
                return $user->last_login_at;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}

