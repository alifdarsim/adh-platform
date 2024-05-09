<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContractTemplate;
use App\Models\ContractExpert;
use App\Models\Country;
use App\Models\Projects;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ContractController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) return $this->datatable();
        return view('admin.contract.index');
    }

    public function datatable()
    {
        $contract_expert = ContractExpert::all();
        $contract_expert->load('project_expert.project', 'project_expert.expert', 'template');
        return datatables()->of($contract_expert)->toJson();
    }

    public function show($cuid)
    {
        $contract_expert = ContractExpert::where('contract_id', $cuid)->get()->first();
        if (!$contract_expert) return view('errors.not-exist');
        $contract_expert->load('project_expert.project', 'project_expert.expert', 'template');
        $templates = ContractTemplate::select(['version', 'language', 'id'])->where('type', 'expert')->get();
        $currencies = Country::select(['currency', 'currency_symbol', 'id'])->get()->unique('currency');
        return view('admin.contract.show', compact( 'contract_expert', 'templates', 'currencies'));
    }

    public function data($cuid)
    {
        return ContractExpert::where('contract_id', $cuid)->orderBy('reversion', 'desc')->get()->first();
    }

    public function update(Request $request, $contract_id)
    {

        $contract = ContractExpert::where('contract_id', $contract_id)->first();
        $data = $request->all();
        $contract->fill($data);
        $contract->save();
        return success('Contract updated successfully');
    }

    public function changeDefaultSignature()
    {
        $file = request()->file('signature');

        // Check if file is valid
        if ($file->isValid()) {
            $originalExtension = $file->getClientOriginalExtension();
            $fileName = 'signatures' . '.png';
            $filePath = public_path('signatures/' . $fileName);
            try {
                $image = Image::make($file);
//                $image->encode('png')->save(public_path('signatures/' . $fileName));
                $image->encode('png')->save($filePath);
                // wait for the image to be saved
                return success('Signature updated successfully');
            } catch (\Exception $e) {
                return error('Error occurred while processing the image: ' . $e->getMessage());
            }
        }

        return error('Invalid file');
    }

}
