<?php

namespace App\Actions\Payment;

use App\Helpers\Helper;
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
        $currentPaymentStatus = $this->webCheckoutService->getInformation($payment->session['requestId']);

        $status = $currentPaymentStatus['status']['status'];
        if (isset($currentPaymentStatus['payment'][0]['status']['status'])) {
            $status = $currentPaymentStatus['payment'][0]['status']['status'];
        }

        $payment->status = strtolower($status);
        $payment->save();

        $order = $payment->order;
        $order->status = strtolower($status);
        $order->save();

        $orderDetails = $order->orderDetails;

        foreach ($orderDetails as $orderDetail) {
            $product = $orderDetail->product;
            $product->stock -= $orderDetail->quantity;
            $product->save();

            if ($product->stock <= 0) {
                Helper::forgetProducts();
            }
        }

        return $payment;
    }
}
