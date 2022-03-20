<?php

namespace App\Http\Controllers\Api;

use App\Actions\Order\StoreOrderAction;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function store(Request $request, StoreOrderAction $storeOrderAction): JsonResponse
    {
        return response()->json([
            'order' => $storeOrderAction->execute($request),
        ]);
    }

    public function index(): JsonResponse
    {
        $orders = Order::with('user','orderDetails.product.images')->where('user_id', auth()->user()['id'])->get();
        return response()->json(compact('orders'));
    }

    public function show($order): JsonResponse
    {
        $order = Order::query()->with(['user','orderDetails.product.images', 'orderDetails.product.categories'])->where('id',$order)->firstOrFail();
        return response()->json(compact('order'));

    }
}
