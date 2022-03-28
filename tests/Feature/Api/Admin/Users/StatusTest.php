<?php

namespace Tests\Feature\Api\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class StatusTest extends TestCase
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

    public function test_error_not_found_when_try_to_update_unknown_user(): void
    {
        $response = $this->putJson($this->endPoint . '/2/status/active', [], $this->headers);
        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => __('general.api.exceptions.model_not_found')]);
    }

    public function test_error_when_try_to_update_user_with_wrong_status(): void
    {
        $user = User::factory(1)->create();
        $response = $this->putJson($this->endPoint . '/' . $user[0]->id . '/status/ready', [], $this->headers);
        $response->assertStatus(422);
        $response->assertJsonFragment(['status' =>[__('validation.in', ['attribute' => 'status'])]]);
    }

    public function test_change_status_to_active_for_an_inactive_user(): void
    {
        $user = User::factory(1)->create(['status' => 'inactive']);
        $response = $this->putJson($this->endPoint . '/' . $user[0]->id . '/status/active', [], $this->headers);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.user.update_status_success')]);

        $userUpdated = User::query()->where('id', $user[0]->id)->first();
        $this->assertEquals('active', $userUpdated->status);
    }

    public function test_change_status_to_inactive_for_an_active_user(): void
    {
        $user = User::factory(1)->create(['status' => 'active']);
        $response = $this->putJson($this->endPoint . '/' . $user[0]->id . '/status/inactive', [], $this->headers);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.user.update_status_success')]);

        $userUpdated = User::query()->where('id', $user[0]->id)->first();
        $this->assertEquals('inactive', $userUpdated->status);
    }
}
