<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        Product::factory(10)->create()->each(function($product){
            $product->categories()->attach(rand(1, 5));
        });
    }
}
