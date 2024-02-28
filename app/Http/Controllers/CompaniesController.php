<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Address;
use App\Models\Client;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\GICSGroup;
use App\Models\GICSIndustry;
use App\Models\GICSSector;
use App\Models\GICSSubIndustry;
use App\Models\Industry;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CompaniesController extends Controller
{
    public function search()
    {
        $query = request()->input('query');
        return Company::select(['id', 'name', 'img_url'])
            ->where('name', 'like', '%' . $query . '%')
            ->take(10)
            ->get();
    }

    public function types()
    {
        return CompanyType::all();
    }

    public function industry()
    {
        $query = request()->input('query');
        return Industry::select(['id', 'name'])
            ->where('name', 'like', '%' . $query . '%')
            ->get();
    }

    public function update()
    {
        $insert = auth()->user()->client->update(request()->all());
        if ($insert) return success('Company updated');
        return error('Company not updated');
    }
}
