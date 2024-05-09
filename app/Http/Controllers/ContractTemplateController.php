<?php

namespace App\Http\Controllers;

use App\Models\ContractTemplate;
use App\Models\ContractExpert;
use App\Models\Projects;
use DataTables;
use Illuminate\Http\Request;

class ContractTemplateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) return $this->getDatatable();
        return view('admin.contract-template.index');
    }

    private function getDatatable()
    {
        $contracts = ContractTemplate::where('type', 'expert')->get();
        return Datatables::of($contracts)
            ->addIndexColumn()
            ->editColumn('content', function ($contract) {
                return substr(strip_tags($contract->content), 0, 80) . '...';
            })
            ->make(true);
    }

    public function show($id)
    {
        $contract = ContractTemplate::find($id);
        return view('admin.contract-template.show', compact('contract'));
    }

    public function update($id)
    {
        $contract = ContractTemplate::find($id);
        $contract->content = request()->contract;
        $contract->save();
        return success('Contract updated successfully');
    }

    public function create()
    {
        return view('admin.contract-template.create');
    }

    public function store()
    {
        $contract = new ContractTemplate();
        $contract->content = request()->contract;
        $contract->language = request()->language;
        $contract->type = 'expert';
        // check if contract with same language exists and if exist create new version
        $contract->version = ContractTemplate::where('language', request()->language)->count() + 1;
        $contract->save();
        return success('Contract updated successfully');
    }

    public function destroy($id)
    {
        $contract = ContractTemplate::find($id);
        $contract->delete();
        return success('Contract deleted successfully');
    }
}
