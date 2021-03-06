<?php

namespace Tests\Feature\Api\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected $endPoint = '/api/products';

    public function test_service_available(): void
    {
        $response = $this->get($this->endPoint);
        $response->assertStatus(200);
    }

    public function test_check_products_empty(): void
    {
        $response = $this->get($this->endPoint);
        $this->assertCount(0, $response->json()['products']['data']);
    }

    public function test_check_all_products(): void
    {
        $keyword = '';
        $categories = Category::factory(3)->create();
        Product::factory(3)->create()->each(function ($product) use ($categories) {
            $product->categories()->attach(rand($categories[0]->id, $categories[2]->id));
        });
        $response = $this->get($this->endPoint . '?page=1&keyword=' . $keyword);

        $this->assertCount(3, $response->json()['products']['data']);
    }
}
