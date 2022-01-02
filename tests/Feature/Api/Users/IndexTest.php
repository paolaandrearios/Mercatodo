<?php

namespace Tests\Feature\Api\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected $endPoint = '/api/users';

    public function test_service_available(): void
    {
        $response = $this->get($this->endPoint);
        $response->assertStatus(200);
    }

    public function test_check_users_empty(): void
    {
        $response = $this->get($this->endPoint);
        $this->assertCount(0, $response->json());
    }

    public function test_check_all_users(): void
    {
        User::factory(3)->create();

        $response = $this->get($this->endPoint);
        $this->assertCount(3, $response->json());
    }
}
