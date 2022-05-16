<?php

namespace Tests\Feature\Api\Orders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use UserApiFaker;
    use RequestFaker;

    protected $endPoint = '/api/client/orders';

    public function test_error_401_when_user_is_unauthenticated(): void
    {
        $response = $this->get($this->endPoint, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);
        $response->assertStatus(401);
    }

    public function test_create_order(): void
    {
        $user = $this->userConfig;

        $products = Product::factory(3)->create();
        $shipping = Order::factory(1)->create(['user_id' => $user['user']['id']])->first();
        $cartItems = [
            [
                'id' => $products[0]->id,
                'quantity' => 2,
                'product_id' => $products[0]->id,
            ],
            [
                'id' => $products[1]->id,
                'quantity' => 4,
                'product_id' => $products[1]->id,
            ],
            [
                'id' => $products[2]->id,
                'quantity' => 1,
                'product_id' => $products[2]->id,
            ],

        ];

        $data = [
            'shipping' => $shipping,
            'cartItems' => $cartItems,
        ];

        $response = $this->postJson($this->endPoint, $data, $this->headers);

        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.order.create_status_success')]);
    }
}
