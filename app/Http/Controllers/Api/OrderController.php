<?php

namespace App\Http\Controllers\Api;

use App\Actions\Order\AddToOrderAction;
use App\Actions\Order\GetItemsOrderAction;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function store(Request $request, AddToOrderAction $addToOrderAction, GetItemsOrderAction $getItemsOrderAction): JsonResponse
    {
        return response()->json([
            'order_detail' => $addToOrderAction->execute($request),
            'order_items' => $getItemsOrderAction->execute($request)
        ]);

//        dd(response()->json['order_items']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
