<?php


namespace App\Actions\Order;



use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\CalculateTotalRepository;
use Illuminate\Http\Request;

class GetItemsOrderAction
{

    Private CalculateTotalRepository $calculateTotalRepository;
    private float $accumTaxes = 0;
    private float $accumSubtotal = 0;
    private float $accumTotal = 0;

    public function __construct(CalculateTotalRepository $calculateTotalRepository)
    {
        $this->calculateTotalRepository = $calculateTotalRepository;
    }

    public function execute(Request $request): array
    {
        $items = OrderDetail::query()
            ->where('status', 'open')
            ->where('order_id', $request->input('order_id'))->get();

        $items->each(function ($item, $key) {
            $product = Product::query()->where('id', $item->product_id)->first();
            list($taxes, $subtotal, $total)  =
                $this->calculateTotalRepository->calculateTotal($product->price, $product->taxes, $item->quantity);

            $item->taxes = $taxes;
            $item->subtotal = $subtotal;
            $item->total = $total;
            $item->save();

            $this->accumTaxes = $this->accumTaxes + $taxes;
            $this->accumSubtotal = $this->accumSubtotal + $subtotal;
            $this->accumTotal = $this->accumTotal + $total;
        });
        return [
            'Taxes' => $this->accumTaxes,
            'Subtotal' => $this->accumSubtotal,
            'Total' => $this->accumTotal
        ];
    }

}
