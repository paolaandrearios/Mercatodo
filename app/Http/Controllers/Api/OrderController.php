<?php

namespace App\Http\Controllers\Api;

use App\Actions\Order\AddToOrderAction;
use App\Actions\Order\GetItemsOrderAction;
use App\Actions\Order\StoreOrderAction;
use App\Http\Controllers\Controller;
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
}
