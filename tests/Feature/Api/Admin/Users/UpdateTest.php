<?php

namespace Tests\Feature\Api\Admin\Users;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
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
        $response = $this->putJson($this->endPoint . '/2', ['name' => 'test'], $this->headers);
        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => __('general.api.exceptions.model_not_found')]);
    }

   /* public function test_update_existent_user(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory(1)->create(['name' => 'Josh', 'role' => 'client'])->first();
        $user->assignRole('client');
        $response = $this->putJson($this->endPoint . '/' . $user->id, ['name' => 'David', 'role' => 'client'], $this->headers);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.user.update_status_success')]);

        $userUpdated = User::query()->where('id', $user->id)->first();
        $this->assertEquals('David', $userUpdated->name);
    }*/
}
