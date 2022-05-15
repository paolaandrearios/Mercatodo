<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $clients = User::query()->where('role', 'client')->get('id');
        $dates = $this->getBetweenDates('2022-04-01', date('Y-m-d'));
        foreach ($clients as $client){
            $quantity = rand(1, 20);
            $randomDate = rand(0, count($dates) - 1);
            $randomDate = $dates[$randomDate];

            Order::factory($quantity)->create(['user_id' => $client->id, 'status' => 'approved'])->each(function ($order) use($products, $randomDate) {
                $productIndex = rand(0, count($products)-1);
                $product = $products[$productIndex];

                OrderDetail::factory()->create([
                    'product_id' => $product->id,
                    'order_id' => $order->id,
                    'quantity' => 1,
                    'taxes' => $product->taxes,
                    'subtotal' => $product->price * (1 - $product->taxes / 100),
                    'total' => $product->price,
                ]);
                $order->taxes = $product->taxes;
                $order->subtotal = $product->price * (1 - $product->taxes / 100);
                $order->total = $product->price;
                $order->updated_at = $randomDate;
                $order->save();
            });
        }
    }

    function getBetweenDates($startDate, $endDate)
    {
        $rangArray = [];

        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        for ($currentDate = $startDate; $currentDate <= $endDate;
             $currentDate += (86400)) {

            $date = date('Y-m-d', $currentDate);
            $rangArray[] = $date;
        }

        return $rangArray;
    }
}
