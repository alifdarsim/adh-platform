<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\ProjectMeeting;
use App\Models\Projects;
use Illuminate\Http\Request;

class AwardedController extends Controller
{
    public function show($pid){
        $project = Projects::where('pid', $pid)->first();
        return view('expert.awarded.index', compact('project'));
    }

    function uploadEvent(Request $request) {
        $request->validate([
            'pid' => 'required',
            'start' => 'required|date_format:Y-m-d\TH:i:sP',
            'end' => 'required|date_format:Y-m-d\TH:i:sP',
        ]);
        $pid = $request->pid;
        $project = Projects::where('pid', $pid)->first();
        $id = ProjectMeeting::insertGetId([
            'project_id' => $project->id,
            'name' => auth()->user()->name,
            'user_id' => auth()->user()->id,
            'start_time' => $request->start,
            'end_time' => $request->end,
        ]);
        return success($id);
    }

    function downloadEvent(Request $request) {
        $request->validate([
            'pid' => 'required',
        ]);
        $pid = $request->pid;
        $project = Projects::where('pid', $pid)->first();
        $meetings = ProjectMeeting::select('id','start_time as start', 'end_time as end', 'name as title', 'user_id as user')
            ->where('project_id', $project->id)
            ->get();
        $meetings = $meetings->map(function($meeting) {
            $meeting->editable = $meeting->user == auth()->user()->id;
            return $meeting;
        });
        $meetings = $meetings->map(function($meeting) {
            unset($meeting->user);
            return $meeting;
        });
        return success($meetings);
    }

    function deleteEvent(Request $request) {
        $request->validate([
            'pid' => 'required',
            'id' => 'required',
        ]);
        $pid = $request->pid;
        $project = Projects::where('pid', $pid)->first();
        ProjectMeeting::where('project_id', $project->id)
            ->where('id', $request->id)
            ->delete();
        return success('File delete successfully');
    }

    function updateEvent(Request $request) {
        $request->validate([
            'pid' => 'required',
            'id' => 'required',
            'start' => 'required|date_format:Y-m-d\TH:i:sP',
            'end' => 'required|date_format:Y-m-d\TH:i:sP',
        ]);
        $pid = $request->pid;
        $project = Projects::where('pid', $pid)->first();
        ProjectMeeting::where('project_id', $project->id)
            ->where('id', $request->id)
            ->update([
                'start_time' => $request->start,
                'end_time' => $request->end,
            ]);
        return success('File update successfully');
    }
}
