<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentExpert;
use App\Models\ProjectPayment;
use App\Models\Projects;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $projects = PaymentExpert::all()->load('projects');
        return view('admin.payment.index', compact('projects'));
    }

    public function confirm()
    {
        $project = Projects::where('pid', request()->pid)->first();
        $payment = $project->payment;
        $payment->update([
            'received_status' => 'confirmed',
        ]);
        return success('Payment confirmed.');
    }

    public function release()
    {
        $payment_proof = request()->file('file');
        $payment_proof_name = time() . '.' . $payment_proof->extension();
        $payment_proof->move(public_path('payment_receipt'), $payment_proof_name);
        $project_id = request()->pid;
        $project = Projects::where('pid', $project_id)->first();
        $payment = $project->payment;
        $payment->update([
            'released_status' => 'released',
            'released_info' => request()->info,
            'released_receipt' => '/payment_receipt/'.$payment_proof_name,
        ]);
        return success('Payment released.');
    }

    public function datatable()
    {
        $projects = PaymentExpert::all()->load('projects')->load('users');
        return datatables()->of($projects)
            ->make(true);
    }
}
