<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientTeam;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return view('client.team.index');
    }

    public function create()
    {
        return view('client.team.create');
    }

    public function store()
    {
        $team_name = request('team_name');
        ClientTeam::create([
            'name' => $team_name,
            'company_id' => auth()->user()->client->company->id,
            'created_by' => auth()->user()->id,
        ]);
        return success('Team created successfully');
    }
}
