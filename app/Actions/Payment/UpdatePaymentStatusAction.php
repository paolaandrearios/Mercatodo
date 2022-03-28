<?php

namespace App\Actions\Payment;

use App\Models\Payment;
use App\Services\WebcheckoutService;
use Illuminate\Support\Facades\Log;

class UpdatePaymentStatusAction
{
    private WebcheckoutService $webCheckoutService;

    public function __construct(WebcheckoutService $webCheckoutService)
    {
        $this->webCheckoutService = $webCheckoutService;
    }

    public function execute(Payment $payment): Payment
    {
        $currentPaymentStatus = $this->webCheckoutService->getInformation($payment->session['requestId']);

        $status = '';
        if (isset($currentPaymentStatus['payment'][0]['status']['status'])) {
            $status = $currentPaymentStatus['payment'][0]['status']['status'];
        } else {
            $status = $currentPaymentStatus['status']['status'];
        }

//        Log::debug(json_encode($currentPaymentStatus));
        $payment->status = strtolower($status);
        $payment->save();

        $order = $payment->order;
        $order->status = strtolower($status);
        $order->save();

        return $payment;
    }
}
