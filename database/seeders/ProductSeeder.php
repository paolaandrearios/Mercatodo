<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory(30)->create()->each(function ($product) {
            $product->categories()->attach(rand(1, 5));
            $product->images()->saveMany([
                new Image(['url'=> '/images/new-product.jpg', 'product_id' => $product->id]),
                new Image(['url'=> '/images/new-category.jpg', 'product_id' => $product->id]),
                new Image(['url'=> '/images/fashion.jpg', 'product_id' => $product->id]),
            ]) ;
        });
    }
}
