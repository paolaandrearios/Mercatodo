<?php

namespace Tests\Feature\Api\Orders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
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

    public function test_error_not_found_when_try_to_update_unknown_order(): void
    {
        $response = $this->patchJson($this->endPoint . '/order/1', ['first_name' => 'test'], $this->headers);
        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => __('general.api.exceptions.model_not_found')]);
    }

    public function test_update_existent_order(): void
    {
        $user =  $this->userConfig;



        $products = Product::factory(3)->create();
        //dd(json_encode($products));
        $order = Order::factory(1)->create(['user_id' => $user['user']['id']])->first();
        dump(json_encode($order));

        OrderDetail::factory(1)->create(['order_id' => $order->id, 'product_id' => $products[0]->id]);
        OrderDetail::factory(1)->create(['order_id' => $order->id, 'product_id' => $products[1]->id]);
        OrderDetail::factory(1)->create(['order_id' => $order->id, 'product_id' => $products[2]->id]);


        $cartItems = [
            [
                'id' => 2,
                'quantity' => 18,
                'product_id' => 2,
                'order_id' => $order->id,
            ],

        ];


        $data = [
            'shipping' => [
                'first_name' => 'Test Test',
                'last_name' => 'Test Test',
                'document_type' => 'citizenship_id',
                'document_number' => '123456789',
                'email' => 'test@test.com',
                'address' => 'Calle 32 nro 11 45',
                'phone' => '6437086598',
                'city' => 'Medellin',
                'postcode' => '050001',
                'notes' => 'This is a updated test',
            ],
            'cartItems' => $cartItems,
        ];

        $response = $this->patchJson($this->endPoint . '/order/' . $order->id, $data, $this->headers);

        dump(json_encode($response));

        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.order.update_status_success')]);

        $orderUpdated = Order::query()->with('orderDetails')->where('id', $order->id)->first();
        $this->assertEquals($data['shipping']['first_name'], $orderUpdated->first_name);
        $this->assertEquals(18 , $orderUpdated->orderDetails[1]->quantity);
    }
}
