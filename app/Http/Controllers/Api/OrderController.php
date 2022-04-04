<?php

namespace App\Http\Controllers\Api;

use App\Actions\Order\CreatePaymentAction;
use App\Actions\Order\StoreOrderAction;
use App\Actions\Order\UpdateOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request, StoreOrderAction $storeOrderAction, CreatePaymentAction $createPaymentAction): JsonResponse
    {
        $order = $storeOrderAction->execute($request);

        return response()->json([
            'order' => $order,
            'payment' => $createPaymentAction->execute($order),
            'message' => __('general.api.order.create_status_success'),
        ]);
    }

    public function index(): JsonResponse
    {
        $orders = Order::with('user', 'orderDetails.product.images', 'payments')
            ->where('user_id', auth()->user()['id'])
            ->orderBy('id', 'desc')
            ->paginate(config('general.custom_client_records_per_page'));

        return response()->json(compact('orders'));
    }

    public function show(int $id): JsonResponse
    {
        $order = Order::query()->with(['user', 'orderDetails.product.images', 'orderDetails.product.categories', 'payments'])->where('id', $id)->firstOrFail();

        return response()->json(compact('order'));
    }

    public function update(StoreOrderRequest $request, Order $order, UpdateOrderAction $updateOrderAction): JsonResponse
    {
        if ($updateOrderAction->execute($order, $request)) {
            return response()->json([
                'message' => __('general.api.order.update_status_success'),
            ]);
        } else {
            return response()->json([
                'message' => __('general.api.order.update_status_error'),
            ]);
        }
    }
}
