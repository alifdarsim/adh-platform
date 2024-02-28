<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminInvitation;
use App\Models\User;
use Config;
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
//        $date = \Carbon\Carbon::now('Asia/Singapore');
//        $date->setTimezone('Asia/Gaza');
//        $date->setTimezone('Asia/Gaza');
//        return $date->timezone->getName(); // This should output 'Asia/Singapore'
//        return $date;

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
            ->addColumn('email', function ($user) {
                return $user->email;
            })
            ->addColumn('name', function ($user) {
                return $user->name;
            })
            ->addColumn('user_avatar', function ($user) {
                return $user->user_avatar($user->name);
            })
            ->addColumn('last_login_at', function ($user) {
                return $user->last_login_at;
            })
            ->make(true);
    }
}

