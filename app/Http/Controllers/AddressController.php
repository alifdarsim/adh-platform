<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function cities_search()
    {
        $cities = City::select('id', 'name')->get();
        return $cities;
    }

    public function states_search()
    {
        $states = State::select('id', 'name')->get();
        return $states;
    }

    public function countries_search(){
        $query = request()->input('query');
        return Country::select(['id', 'name', 'emoji'])
            ->where('name', 'like', '%' . $query . '%')
            ->take(10)
            ->get();
    }

    public function countries(){
        return Country::select(['id', 'name', 'emoji'])->get();
    }
}
