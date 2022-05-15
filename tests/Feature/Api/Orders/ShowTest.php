<?php

namespace Tests\Feature\Api\Orders;

use App\Models\Order;
use Database\Seeders\CategorySeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ProductVisitsPerDaySeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use UserApiFaker;
    use RequestFaker;

    protected $endPoint = '/api/client/orders/order/';

    public function test_error_401_when_user_is_unauthenticated(): void
    {
        $response = $this->get($this->endPoint . '1', [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);
        $response->assertStatus(401);
    }


    public function test_check_order_not_exists(): void
    {
        $response = $this->get($this->endPoint . '1', $this->headers);
        $response->assertNotFound();
        $response->assertJsonFragment(['message' => 'Element Not Found']);
    }

    public function test_check_order_exists(): void
    {

        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);
        $this->seed(OrderSeeder::class);
        $this->seed(ProductVisitsPerDaySeeder::class);

        $order = Order::query()->first();
        $response = $this->get($this->endPoint . $order->id, $this->headers);
        $response->assertOk();
        $this->assertEquals($order->reference, $response->json()['order']['reference']);
        $this->assertEquals($order->email, $response->json()['order']['email']);
    }
}
