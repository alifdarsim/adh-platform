<?php

namespace App\Http\Controllers;

use App\Models\IndustryExpert;
use Illuminate\Http\Request;

class IndustryExpertController extends Controller
{
    public function main()
    {
        return IndustryExpert::select('main')->distinct()->pluck('main')->toArray();
    }

    public function sub($main)
    {
        $main = str_replace('_', '/', $main);
        return IndustryExpert::where('main', $main)->select('id','sub')->get();
    }

}
