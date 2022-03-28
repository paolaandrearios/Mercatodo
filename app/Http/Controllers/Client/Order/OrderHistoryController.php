<?php

namespace App\Http\Controllers\Client\Order;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class OrderHistoryController extends Controller
{
    public function show(): view
    {
        return view('client.order.history');
    }
}
