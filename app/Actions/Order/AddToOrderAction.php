<?php


namespace App\Actions\Order;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\CalculateTotalRepository;
use Illuminate\Http\Request;

class AddToOrderAction
{
    Private CalculateTotalRepository $calculateTotalRepository;

    public function __construct(CalculateTotalRepository $calculateTotalRepository)
    {
        $this->calculateTotalRepository = $calculateTotalRepository;
    }

    public function execute(Request $request): OrderDetail
    {
        //todo: falta filtrar por el usuario autenticado, un usuario sólo puede tener una orden abierta
        $order = Order::query()->where('status', 'open')->first();

        if(!$order){
            $order = new Order();
            $order->save();
        }

        $order_detail = OrderDetail::query()
            ->where('product_id', $request->input('product_id'))
            ->where('order_id', $order->id)->first();

        $product = Product::query()->where('id', $request->input('product_id'))->first();

        if(!$order_detail) {
            $order_detail = new OrderDetail();
            $order_detail->product_id = $request->input('product_id');
            $order_detail->order_id = $request->input('order_id');
        }
        $order_detail->quantity = $request->input('quantity');

        list($taxes, $subtotal, $total)  =
            $this->calculateTotalRepository->calculateTotal($product->price, $product->taxes, $order_detail->quantity);

        $order_detail->taxes = $taxes;
        $order_detail->subtotal = $subtotal;
        $order_detail->total = $total;

        $order_detail->save();



        //calcular total de la orden
        //todo: actualizar totales de la orden

        return $order_detail;
    }
}
