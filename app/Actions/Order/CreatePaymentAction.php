<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\Payment;
use App\Services\WebcheckoutService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;


class CreatePaymentAction
{
    private string $reference;

    public function execute(Order $order): Payment
    {
        $session = $this->createSessionWC($order);

        $payment = new Payment();
        $payment->session = json_encode($session);
        $payment->reference = $this->reference;
        $payment->url = $session['processUrl'];
        $payment->order_id = $order->id;
        $payment->total = $order->total;

        $payment->save();

        return $payment;
    }


    private function createSessionWC(Order $order): array
    {
        $data = [];
        if(App::getLocale() == 'es'){
            $locale = App::getLocale().'_'.'CO';
        } else {
            $locale = App::getLocale().'_'.'US';
        }
        $data['locale'] = $locale;
        $this->reference = strtoupper(substr(md5(uniqid(rand(), true)),0,10));
        $data['buyer'] = [
            'name' => $order->first_name,
            'surname' => $order->last_name,
            'email' => $order->email,
        ];
        $data['payment'] = [
            'reference' => $this->reference,
            'description' => __('general.api.checkout.payment_description', ['attribute' => $order->reference]),
            'amount' => [
                'currency' => 'COP',
                'total' => $order->total,
            ]
        ];
        $data['returnUrl'] = route('client.order.thanks');
        $data['cancelUrl'] = route('orders.history');
        $data['expiration'] = date('c', strtotime('+2 days'));
//        Log::debug(json_encode($data));
        return (new WebcheckoutService())->createSession($data);
    }
}
