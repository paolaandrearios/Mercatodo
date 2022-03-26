<?php

namespace App\Http\Controllers\Api;

use App\Actions\Order\CreatePaymentAction;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Services\WebcheckoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private WebcheckoutService $webCheckoutService;
    public function __construct(WebcheckoutService $webCheckoutService)
    {
        $this->webCheckoutService = $webCheckoutService;
    }

    public function store(Order $order, CreatePaymentAction $createPaymentAction): JsonResponse
    {
        $currentPayment = Payment::query()
            ->where('order_id', $order->id)
            ->where('status', 'pending')
            ->orderBy('id', 'desc')
            ->first();

        if(is_null($currentPayment)){
            $currentPayment = $createPaymentAction->execute($order);
        } else {
            $currentPaymentStatus = $this->webCheckoutService->getInformation($currentPayment->session['requestId']);
            if($currentPaymentStatus['status']['status'] !== 'PENDING'){
                $currentPayment = $createPaymentAction->execute($order);
            }
        }

        return response()->json([
            'order' => $order,
            'payment' => $currentPayment,
        ]);
    }
}
