<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractExpert;
use App\Models\Projects;

class ContractController extends Controller
{
    public function show($type)
    {
        $contract = Contract::where('type', $type)->first();
        return view('admin.contract.index', compact('contract'));
    }

    public function store()
    {
        $type = request()->type;
        $contract = Contract::where('type', $type)->first();
        if (!$contract) {
            $contract = new Contract();
        }
        $contract->content = request()->contract;
        $contract->save();
        return success('Contract updated successfully');
    }

    public function update($pid)
    {
        $contract = request()->contract;
        $status = request()->status;
        // get content from request
        if (empty($contract)) {
            return error('Contract content is empty, start draft your contract using the default contract as a guide.');
        }
        $project = Projects::where('pid', $pid)->first();
        $project->contract()->updateOrCreate(
            ['project_id' => $project->id],
            [
                'content' => $contract,
                'status' => $status
            ]
        );
        return success('Contract updated successfully');
    }

    public function upload($project_expert_id, $type, $state)
    {
        $file = request()->file('contract');
        //rename file to a unique name
        $name = $this->generateUniqueId() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('contracts'), $name);
        // get full path of the file
        $name = 'contracts/' . $name;
        $contract = ContractExpert::where('project_expert_id', $project_expert_id)->first();
        if (!$contract) {
            $contract = new ContractExpert();
        }
        $contract = $contract->updateOrCreate(
            [
                'project_expert_id' => $project_expert_id,
                'type' => $type,
                'state' => $state
            ],
            [
                'filepath' => $name
            ]
        );
        if ($contract) {
            return success('Contract uploaded successfully');
        }
        return error('An error occurred while uploading contract');
    }

    public function check_status($project_expert_id)
    {
        $contract = ContractExpert::where('project_expert_id', $project_expert_id)->get();
        if ($contract) {
            return [
                '1' => $contract->where('state', 1)->first(),
                '2' => $contract->where('state', 2)->first(),
                '3' => $contract->where('state', 3)->first(),
            ];
        }
        return error('Contract not uploaded');
    }

    public function default($type)
    {
        return Contract::where('type', $type)->first()->content;
    }

    function generateUniqueId($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

}
