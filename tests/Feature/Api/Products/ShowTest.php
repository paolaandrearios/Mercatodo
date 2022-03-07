<?php

namespace Tests\Feature\Api\Products;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    protected $endPoint = '/api/product/';

    public function test_service_available(): void
    {
        $category = Category::factory(1)->create()->first();
        $product = Product::factory(1)->create()->first();
        $product->categories()->attach($category->id);
        $response = $this->get($this->endPoint.$product->slug);
        $response->assertStatus(200);
    }


    public function test_see_product_details(): void
    {
        $category = Category::factory(1)->create()->first();
        $product = Product::factory(1)->create(['slug' => 'slug'])->first();
        $product->categories()->attach($category->id);
        $product->images()->saveMany([
        new Image(['url'=> '/images/new-product.jpg', 'product_id' => $product->id]),
        new Image(['url'=> '/images/new-category.jpg', 'product_id' => $product->id]),
        new Image(['url'=> '/images/fashion.jpg', 'product_id' => $product->id]),
        ]);

        $response = $this->get($this->endPoint.$product->slug);

        $response->assertJsonFragment([
            'slug' => 'slug',
            "url" => "/images/new-product.jpg",
            "type" => "category",
        ]);
    }

    public function test_error_when_try_to_find_product_with_unknown_slug(): void
    {
        $category = Category::factory(1)->create()->first();
        $product = Product::factory(1)->create()->first();
        $product->categories()->attach($category->id);
        $product->images()->saveMany([
            new Image(['url'=> '/images/new-product.jpg', 'product_id' => $product->id]),
            new Image(['url'=> '/images/new-category.jpg', 'product_id' => $product->id]),
            new Image(['url'=> '/images/fashion.jpg', 'product_id' => $product->id]),
        ]);

        $response = $this->get($this->endPoint.'new-product');

        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => __('general.api.exceptions.model_not_found')]);
    }

}
