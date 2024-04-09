<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PaymentClient;
use App\Models\PaymentExpert;
use App\Models\ProjectExpert;
use App\Models\Projects;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $project_ids = Projects::where('created_by', auth()->id())->pluck('id');
        $projects = PaymentClient::whereIn('project_id', $project_ids)->get()->load('project');
        $projects = $projects->filter(function ($project) {
            if ($project->payment !== null && $project->payment->confirm === 1) {
                return $project;
            }
            return null;
        });
        return view('client.payment.index', compact('projects'));
    }

    public function store()
    {
        $payment_proof = request()->file('file');
        $payment_proof_name = time() . '.' . $payment_proof->extension();
        $payment_proof->move(public_path('payment_receipt'), $payment_proof_name);
        $project_id = request()->pid;
        $project = Projects::where('pid', $project_id)->first();
        $payment = $project->payment;
        $payment->update([
            'received_status' => 'pending_verification',
            'received_info' => request()->info,
            'received_receipt' => '/payment_receipt/'.$payment_proof_name,
        ]);
        return success('Payment uploaded. Admin will confirm your payment soon.');
    }

    public function datatable()
    {
        $projects = Projects::where('created_by', auth()->id())->get()->load('payment');
        $projects = $projects->filter(function ($project) {
            if ($project->payment !== null && $project->payment->confirm === 1) {
                return $project;
            }
            return null;
        });
//        $payments = $projects->map(function ($project) {
//            return $project->payment;
//        });
        return datatables()->of($projects)
//            ->addColumn('action', function ($project) {
//                return '<a href="' . route('client.payment.show', $project->id) . '" class="btn btn-primary btn-sm">Detail</a>';
//            })
//            ->addIndexColumn()
//            ->rawColumns(['action'])
            ->make(true);
    }
}
