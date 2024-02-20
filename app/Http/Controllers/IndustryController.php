<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\IndustryExpert;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index()
    {
        return IndustryExpert::all();
    }

    public function type($type)
    {
        if ($type == 'sub') {
            return IndustryExpert::select('id','sub AS data')->get();
        }
        else {
            return IndustryExpert::select('id','main AS data')->distinct()->get();
        }
    }
}
