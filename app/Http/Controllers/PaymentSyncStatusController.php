<?php

namespace App\Http\Controllers;

use App\Actions\Payment\UpdatePaymentStatusAction;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;

class PaymentSyncStatusController extends Controller
{
    public function update(Order $order, UpdatePaymentStatusAction $updatePaymentStatusAction): JsonResponse
    {
        $payment = Payment::query()->with('order')->where('order_id', $order->id)
            ->orderBy('id', 'desc')
            ->first();

        return response()->json([
            'payment' => $updatePaymentStatusAction->execute($payment),
        ]);
    }
}
