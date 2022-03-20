<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;


class OrderAdminController extends Controller
{

    public function index(): JsonResponse
    {
        $orders = Order::with('user','orderDetails.product.images')->get();
        return response()->json(compact('orders'));
    }

    public function show($order): JsonResponse
    {
        $order = Order::query()->with(['user','orderDetails.product.images', 'orderDetails.product.categories'])->where('id',$order)->firstOrFail();
        return response()->json(compact('order'));

    }
}
