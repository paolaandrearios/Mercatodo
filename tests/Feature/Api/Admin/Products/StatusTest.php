<?php

namespace Tests\Feature\Api\Admin\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    protected $endPoint = '/api/admin/products';

    public function test_error_not_found_when_try_to_update_unknown_products(): void
    {
        $response = $this->putJson($this->endPoint . '/1/status/active');
        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => __('general.api.exceptions.model_not_found')]);
    }

    public function test_error_when_try_to_update_product_with_wrong_status(): void
    {
        $product = Product::factory(1)->create();
        $response = $this->putJson($this->endPoint . '/' . $product[0]->id . '/status/ready');
        $response->assertStatus(422);
        $response->assertJsonFragment(['status' =>[__('validation.in', ['attribute' => 'status'])]]);
    }

    public function test_change_status_to_active_for_an_inactive_product(): void
    {
        $product = Product::factory(1)->create(['status' => 'inactive'])->first();
        $response = $this->putJson($this->endPoint . '/' . $product->id . '/status/active');
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.product.update_status_success')]);

        $productUpdated = Product::query()->where('id', $product->id)->first();
        $this->assertEquals('active', $productUpdated->status);
    }

    public function test_change_status_to_inactive_for_an_active_product(): void
    {
        $product = Product::factory(1)->create(['status' => 'active']);
        $response = $this->putJson($this->endPoint . '/' . $product[0]->id . '/status/inactive');
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.product.update_status_success')]);

        $productUpdated = Product::query()->where('id', $product[0]->id)->first();
        $this->assertEquals('inactive', $productUpdated->status);
    }
}
