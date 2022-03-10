<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{

    public function run(): void
    {
/*        $product = Product::all()->first();
        Order::factory(10)->create()->each(function ($order) use($product) {
            $order->orderDetails()->saveMany([
                new OrderDetail(['quantity'=> 2, 'product_id' => $product->id]),
                new OrderDetail(['quantity'=> 1, 'product_id' => $product->id]),
                new OrderDetail(['quantity'=> 3, 'product_id' => $product->id]),
            ]) ;
        });*/
    }
}
