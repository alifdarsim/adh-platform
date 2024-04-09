<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\ExpertLinkedInQueue;
use App\Models\ExpertList;
use App\Models\ProjectExpert;
use App\Models\User;
use App\Models\UserExpert;
use Illuminate\Http\Request;

class ExpertPortalController extends Controller
{
    public function index($id)
    {
        return view('admin.expert-portal.index', compact('id'));
    }

    public function get($id)
    {
        $expert = ExpertList::find($id);
        $user = User::where('email', $expert->email)->first();
        if ($user) {
            $user->expert->industry;
            if (!$user->expert->url) $user->expert->url = $expert->url;
            if (!$user->expert->country) $user->expert->country = $expert->country;
            $country_name = $user->expert->country;
            $emoji = Country::where('name', $country_name)->select('emoji')->first();
            $user->expert->country = $emoji->emoji . ' ' . $country_name;
            $user->last_login = $user->lastLoginAt() ? $user->lastLoginAt()->format('d/m/Y H:i A') : '-';
            $user->register_at = $user->created_at->format('d/m/Y H:i A');
            $user_project = ProjectExpert::where('expert_id', $id)->get();
            $user->project_count = $user_project->where('status', '<>', 'shortlisted')->count();
            $user->project_ongoing = $user_project->whereIn('status', ['ongoing'])->count();
            $user->project_completed = $user_project->where('status', 'completed')->count();
            return $user;
        } else {
            return success($expert);
        }
    }

    public function getExpertDetails($id)
    {
        $expert = ExpertList::find($id);
        // get user expert information
        $user_expert = $this->UserExpertData($expert->email);
        return $user_expert;
    }

    public function datatableOngoing($id)
    {
        $datatable = $this->getProjectHistory(['ongoing'], $id);
        return datatables()->of($datatable)
            ->make(true);
    }

    public function getProjectHistory($status, $id)
    {
        return ProjectExpert::where('expert_id', $id)
            ->whereIn('status', $status)
            ->get()
            ->load('project')
            ->load('payment')
            ->load('contract');
    }

    public function datatableComplete($id)
    {
        $datatable = $this->getProjectHistory(['completed'], $id);
        return datatables()->of($datatable)
            ->make(true);
    }

    public function UserExpertData($email)
    {
        $user_expert = UserExpert::where('email', $email)->first();
        $expert_list = ExpertList::where('email', $email)->first();
        $data = new \stdClass();
        if ($user_expert) {
            $data->linked_url = $user_expert->url ?? $expert_list->url;
            $data->about = $user_expert->about ?? $expert_list->about;
            $data->img_url = $user_expert->img_url ?? $expert_list->img_url;
            $data->country = $user_expert->country ?? $expert_list->country;
            $data->industry = $user_expert->industry ?? $expert_list->industry;
            $data->address = $user_expert->address ?? $expert_list->address;
            $data->skills = $user_expert->skills ?? $expert_list->skills;
            $data->languages = $user_expert->languages ?? $expert_list->languages;
            $data->experiences = $user_expert->experiences ?? $expert_list->experiences;
            return $data;
        } else {
            return null;
        }
    }
}
