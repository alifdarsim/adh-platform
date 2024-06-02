<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\ExpertImport;
use App\Models\ExpertList;
use App\Models\ProjectExpert;
use App\Models\User;
use Illuminate\Http\Request;

class ExpertPortalController extends Controller
{
    public function show($id)
    {
        $expert_user = $this->getExpertOrUserData($id);
        return view('admin.expert-portal.show', compact('expert_user', 'id'));
    }

    public function getExpertOrUserData($id)
    {
        $expert = ExpertList::find($id);
        $user = User::where('email', $expert->email)->first();
        if ($user) {
            $user->id = $id;
            $user->phone = $user->phone_code  . $user->phone;
            $user->industry_main = $user->expert->industry->main ?? null;
            $user->industry_sub = $user->expert->industry->sub ?? null;
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

    public function viewFromImport($id)
    {
        $linkedin = ExpertImport::find($id)->linkedin_url;
        if (str_ends_with($linkedin, '/')) $linkedin = substr($linkedin, 0, -1);
        $expert = ExpertList::where('url', $linkedin)->first();
        if ($expert) {
            return redirect()->route('admin.expert-portal.show', $expert->id);
        }
        return "If see this, then something weird happen during import process";
    }

//    public function viewFromRegistered($id)
//    {
//        $linkedin = ExpertImport::find($id)->linkedin_url;
//        if (str_ends_with($linkedin, '/')) $linkedin = substr($linkedin, 0, -1);
//        $expert = ExpertList::where('url', $linkedin)->first();
//        if ($expert) {
//            return redirect()->route('admin.expert-portal.show', $expert->id);
//        }
//        return "If see this, then something weird happen during import process";
//    }
}
