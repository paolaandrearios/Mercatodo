<?php

namespace App\Actions\Order;

use App\Http\Requests\Api\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\CalculateTotalRepository;
use Illuminate\Support\Facades\Auth;

class StoreOrderAction
{
    private CalculateTotalRepository $calculateTotalRepository;
    private float $accumTaxes = 0;
    private float $accumSubtotal = 0;
    private float $accumTotal = 0;

    public function __construct(CalculateTotalRepository $calculateTotalRepository)
    {
        $this->calculateTotalRepository = $calculateTotalRepository;
    }

    public function execute(StoreOrderRequest $request): Order
    {
        $order = new Order();
        $order->reference = strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        $shipping = $request->input('shipping');
        $order->first_name = $shipping['first_name'];
        $order->last_name = $shipping['last_name'];
        $order->document_type = $shipping['document_type'];
        $order->document_number = $shipping['document_number'];
        $order->email = $shipping['email'];
        $order->address = $shipping['address'];
        $order->city = $shipping['city'];
        $order->postcode = $shipping['postcode'];
        $order->phone = $shipping['phone'];
        $order->notes = $shipping['notes'];
        $order->user_id = Auth::user()->id;

        $order->save();

        foreach ($request->input('cartItems') as $item) {
            $product = Product::query()->where('id', $item['id'])->firstOrFail();
            $orderDetails = new OrderDetail();
            $orderDetails->product_id = $item['product_id'];
            $orderDetails->order_id = $order->id;
            $orderDetails->quantity = $item['quantity'];
            list($taxes, $subtotal, $total) =
                $this->calculateTotalRepository->calculateTotal($product->price, $product->taxes, $item['quantity']);
            $orderDetails->taxes = $taxes;
            $orderDetails->subtotal = $subtotal;
            $orderDetails->total = $total;
            $orderDetails->save();

            $this->accumTaxes = $this->accumTaxes + $taxes;
            $this->accumSubtotal = $this->accumSubtotal + $subtotal;
            $this->accumTotal = $this->accumTotal + $total;
        }

        $order->taxes = $this->accumTaxes;
        $order->subtotal = $this->accumSubtotal;
        $order->total = $this->accumTotal;

        $order->save();

        return $order;
    }
}
