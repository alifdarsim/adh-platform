<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\ContractTemplate;
use App\Models\ContractExpert;
use App\Models\Country;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) return $this->getDatatable();
        return view('expert.contract.index');
    }

    public function getDatatable()
    {
        $contracts = ContractExpert::where('status', '!=', 'pending')
            ->get()->load('project_expert.project', 'project_expert.expert');
        $contracts = $contracts->filter(function ($contract) {
            return $contract->project_expert->expert_id == auth()->user()->expert->id;
        });
        return datatables()->of($contracts)->toJson();
    }

    public function show($contract_id)
    {
        $contract_expert = ContractExpert::where('contract_id', $contract_id)->get()->first();
        $contract_expert->load('project_expert.project', 'project_expert.expert', 'template');
        $currencies = Country::select(['currency', 'currency_symbol', 'id'])->get()->unique('currency');
        if ($contract_expert->status == 'submitted') {
            return view('expert.contract.show_submit', compact('contract_expert', 'currencies'));
        }
        return view('expert.contract.show', compact( 'contract_expert', 'currencies'));
    }

    public function update($contract_id)
    {
        $contract = ContractExpert::where('contract_id', $contract_id)->first();
        $data = \request()->all();
        $contract->fill($data);
        $contract->status = 'submitted';
        $contract->save();
        return success('Contract updated successfully');
    }
}
