<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\PaymentExpert;
use App\Models\ProjectExpert;
use App\Models\Projects;

class PaymentController extends Controller
{

    public function index()
    {
        $project_expert_ids = ProjectExpert::where('expert_id', auth()->user()->expert->id ?? null)->pluck('project_id');
        $payments = PaymentExpert::whereIn('project_expert_id', $project_expert_ids)->get()->load('project');
//        return $payments;
        $projects = $payments->filter(function ($project) {
            if ($project->payment !== null && $project->payment->confirm === 1) {
                return $project;
            }
            return null;
        });
        return view('expert.payment.index', compact('projects'));
    }

    public function datatable()
    {
        $projects = Projects::where('awarded_to', auth()->id())->get()->load('payment');
        $projects = $projects->filter(function ($project) {
            if ($project->payment !== null && $project->payment->confirm === 1 && $project->status === 'closed') {
                return $project;
            }
            return null;
        });
        return datatables()->of($projects)
            ->make(true);
    }

    public function updatePaymentMethod()
    {
        $method = request('method');
        $payment_info = request('payment_info');
        $user = auth()->user();
        $user->payment()->updateOrCreate([], ['method' => $method , 'payment_info' => $payment_info]);
        return success('Payment method updated successfully');
    }
}
