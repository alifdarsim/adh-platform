<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpertDataController extends Controller
{
    public function index()
    {
        return view('expert.expert.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string'
        ]);
        $user = auth()->user();
        $user->phone = $request->phone;
        $user->name = $request->name;
        $expert = $user->expert;
        $expert->about = $request->about;
        $expert->save();
        $user->save();
        return success('Profile updated successfully');
    }

    public function jobAdd(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'company' => 'required|string',
            'address' => 'required|string',
            'start_month' => 'required|string',
            'start_year' => 'required|string',
            'end_month' => 'required|string',
            'end_year' => 'required|string',
        ]);
        $expert = auth()->user()->expert;
        $position = $expert->position;
        $position[] = [
            'title' => $request->title,
            'companyName' => $request->company,
            'location' => $request->address,
            'description' => '', //TODO add description
            'employmentType' => '', //TODO add employment type
            'start' => [
                'day' => 0,
                'month' => Carbon::createFromFormat('M', $request->start_month)->month,
                'year' => (int)$request->start_year,
            ],
            'end' => [
                'day' => 0,
                'month' => Carbon::createFromFormat('M', $request->end_month)->month,
                'year' => (int)$request->end_year,
            ],
        ];

        // Define the comparison as a closure
        $comparePositions = function($a, $b) {
            $aStart = Carbon::createFromDate($a['start']['year'], $a['start']['month'], $a['start']['day']);
            $bStart = Carbon::createFromDate($b['start']['year'], $b['start']['month'], $b['start']['day']);

            if ($aStart->eq($bStart)) {
                return 0;
            }
            return $aStart->lt($bStart) ? 1 : -1;
        };
        usort($position, $comparePositions);
        $expert->position = $position;
        $expert->save();
        return success('Job experience added successfully');
    }

    public function jobRemove(Request $request)
    {
        $title = $request->title;
        $company = $request->company;
        $expert = auth()->user()->expert;
        $position = $expert->position;
        $index = -1; // Initialize the index to -1, indicating no match found initially
        foreach ($position as $key => $value) {
            if ($value['title'] === $title && $value['companyName'] === $company) {
                $index = $key; // Set the index to the current position if a match is found
                break; // Exit the loop since we found a match
            }
        }
        if ($index === -1) {
            return error('Job experience not found. Something is wrong, please try again');
        }
        array_splice($position, $index, 1);
        $expert->position = $position;
        $expert->save();
        return success('Job experience removed successfully');
    }
}
