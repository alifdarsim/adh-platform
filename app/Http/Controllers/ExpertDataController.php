<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpertDataController extends Controller
{
//    public function index()
//    {
//        return view('expert.expert.index');
//    }



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
