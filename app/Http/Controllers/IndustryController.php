<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index()
    {
        return Industry::all();
    }

    public function search(Request $request)
    {
        $query = $request->query;
        return $query;
        $industries = Industry::where('name', 'like', '%' . $request->query . '%')->get();
        return response()->json($industries);
    }
}
