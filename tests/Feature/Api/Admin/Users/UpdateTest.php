<?php

namespace Tests\Feature\Api\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected $endPoint = '/api/admin/users';

    public function test_error_not_found_when_try_to_update_unknown_user(): void
    {
        $response = $this->putJson($this->endPoint . '/1', ['name' => 'test']);
        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => __('general.api.exceptions.model_not_found')]);
    }

    public function test_update_existent_user(): void
    {
        $user = User::factory(1)->create(['name' => 'Josh'])->first();

        $response = $this->putJson($this->endPoint . '/' . $user->id, ['name' => 'David']);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.user.update_status_success')]);

        $userUpdated = User::query()->where('id', $user->id)->first();
        $this->assertEquals('David', $userUpdated->name);
    }
}
