<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index()
    {
        $projects = Projects::where('awarded_to', auth()->id())->get()->load('payment');
        $projects = $projects->filter(function ($project) {
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
