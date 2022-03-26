<?php

namespace App\Actions\Payment;

use App\Models\Payment;
use App\Services\WebcheckoutService;

class UpdatePaymentStatusAction
{
    private WebcheckoutService $webCheckoutService;
    public function __construct(WebcheckoutService $webCheckoutService)
    {
        $this->webCheckoutService = $webCheckoutService;
    }

    public function execute(Payment $payment): Payment
    {
        if($payment->status === 'approved'){
            return $payment;
        }
        $currentPaymentStatus = $this->webCheckoutService->getInformation($payment->session['requestId']);
        if($currentPaymentStatus['status']['status'] !== 'PENDING'){
            $payment->status = strtolower($currentPaymentStatus['status']['status']);
            $payment->save();

            if($currentPaymentStatus['status']['status'] === 'APPROVED'){
                $order = $payment->order;
                $order->status = 'approved';
                $order->save();
            }
        }
        return $payment;
    }



}
