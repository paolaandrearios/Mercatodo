<?php

namespace App\Http\Controllers\Client\Order;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{
    public function show(): view
    {
        return view('client.order.checkout');
    }
}
