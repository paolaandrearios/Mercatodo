<?php

namespace App\Http\Controllers\Client\Order;

use Illuminate\Contracts\View\View;

class CartController
{
    public function show(): view
    {
        return view('client.order.cart');
    }
}
