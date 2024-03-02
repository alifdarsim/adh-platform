<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function updatePaymentMethod()
    {
        $method = request('method');
        $payment_info = request('payment_info');
        $user = auth()->user();
        $user->payment()->updateOrCreate([], ['method' => $method , 'payment_info' => $payment_info]);
        return success('Payment method updated successfully');
    }
}
