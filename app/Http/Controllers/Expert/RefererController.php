<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RefererController extends Controller
{
    public function index()
    {
        $referer_code = auth()->user()->referer_code;
        return view('expert.referer.index', compact('referer_code'));
    }
}
