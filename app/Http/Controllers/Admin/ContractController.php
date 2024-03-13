<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ProjectContract;
use App\Models\Projects;
use Illuminate\Http\Request;

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

    public function upload($pid, $type, $status)
    {
        $file = request()->file('contract');
        //rename file to a unique name
        $name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('contracts'), $name);
        $project = Projects::where('pid', $pid)->first();
        $contract = $project->contract()->updateOrCreate(
            [
                'project_id' => $project->id,
                'type' => $type,
                'status' => $status
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

}
