<?php

namespace Tests\Feature\Api\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use UserApiFaker;
    use RequestFaker;

    protected $endPoint = '/api/admin/users';

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

    public function test_check_all_users(): void
    {
        User::factory(3)->create();

        $response = $this->get($this->endPoint, $this->headers);
        $this->assertCount(4, $response->json()['data']);
    }
}
