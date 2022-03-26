<?php


namespace App\Http\Controllers\Client\Order;


use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;


class OrderThanksController extends Controller
{
    public function show(string $order): view
    {
        return view('client.order.thanks', compact('order'));
    }
}
