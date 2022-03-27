<?php

namespace Tests\Feature\Api\Orders;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class IndexTest extends TestCase
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

    public function test_service_available(): void
    {
        $response = $this->get($this->endPoint, $this->headers);
        $response->assertStatus(200);
    }

    public function test_check_orders_empty(): void
    {
        $response = $this->get($this->endPoint, $this->headers);
        $this->assertCount(0, $response->json()['orders']['data']);
    }

    public function test_check_all_orders(): void
    {
        $user =  $this->userConfig;

        $orders = Order::factory(3)->create(['user_id' => $user['user']['id']]);

        $response = $this->get($this->endPoint, $this->headers);

        $this->assertCount(3, $response->json()['orders']['data']);
    }
}
