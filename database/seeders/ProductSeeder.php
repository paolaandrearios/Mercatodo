<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all('id');
        foreach ($categories as $category) {
            Product::factory(6)->create()->each(function ($product) use ($category) {
                $product->categories()->attach($category);
                $product->images()->saveMany([
                    new Image(['url'=> '/images/new-product.jpg', 'product_id' => $product->id]),
                    new Image(['url'=> '/images/new-category.jpg', 'product_id' => $product->id]),
                    new Image(['url'=> '/images/fashion.jpg', 'product_id' => $product->id]),
                ]);

            });
        }

    }
}
