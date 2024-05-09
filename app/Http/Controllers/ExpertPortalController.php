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
    public function show($id)
    {
        $expert_user = $this->getExpertOrUserData($id);
//        return $expert_user;
        return view('admin.expert-portal.show', compact('expert_user'));
    }

    public function getExpertOrUserData($id)
    {
        $expert = ExpertList::find($id);
        $user = User::where('email', $expert->email)->first();
        if ($user) {
//            $user->email = $expert->email;
//            $user->name = $expert->name;
            $user->phone = $user->phone_code  . $user->phone;
            $user->industry_main = $user->expert->industry->main;
            $user->industry_sub = $user->expert->industry->sub;
            $user->url = $user->expert->url;
            $user->country = $user->expert->country;
            $user->address = $user->expert->address;
            $user->skills = $user->expert->skills;
            $user->languages = $user->expert->languages;
            $user->experiences = $user->expert->experiences;
            $user->img_url = $user->avatar_path ?? $user->expert->img_url;
            $user->about = $user->expert->about;
            $user->registered_at = $user->created_at->format('d/m/Y H:i A');
            $user->total_projects = ProjectExpert::where('expert_id', $id)->where('awarded', 1)->count();
            $user->total_ongoing = ProjectExpert::where('expert_id', $id)->where('status', 'ongoing')->count();
            $user->total_completed = ProjectExpert::where('expert_id', $id)->where('status', 'completed')->count();
            return $user;
        } else {
            return $expert;
        }
    }

    public function update($id, Request $request)
    {
        $expert = ExpertList::find($id);
        $expert->update($request->all());
        return success('Expert updated successfully');
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
