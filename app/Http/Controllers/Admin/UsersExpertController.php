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

class UsersExpertController extends Controller
{
    /**
     * Show the users' dashboard.
     */
    public function index()
    {
        if (\request()->ajax()) return $this->datatable();
        return view('admin.users.expert.index');
    }

    /**
     * Show the datatable data of admin user.
     * @throws Exception
     * @throws \Exception
     */
    public function datatable()
    {
        // get all user with role user using datatable query
        $users = User::where('role', 'expert')->get();
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
                return $user->lastLoginAt();
            })
            ->addColumn('expert_id', function ($user) {
                if ($user->expert) return $user->expert->id;
                else return null;
            })
            ->make(true);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return success('User deleted successfully');
        }
        return error('User not found');
    }
}

