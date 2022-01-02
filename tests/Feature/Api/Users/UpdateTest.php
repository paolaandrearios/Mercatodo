<?php

namespace Tests\Feature\Api\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase ;

    protected $endPoint = '/api/users';

    public function test_error_not_found_when_try_to_update_unknown_user(): void
    {
        $response = $this->putJson($this->endPoint . '/1', ['name' => 'test']);
        $response->assertStatus(422);
        $response->assertJsonFragment(["id" =>["The selected id is invalid."]]);
    }

    public function test_update_existent_user():void
    {
        $user = User::factory(1)->create(['name' => 'Josh']);

        $response = $this->putJson($this->endPoint . '/' . $user[0]->id, ['name' => 'David']);
        $response->assertOk();
        $response->assertJsonFragment(["message" => "Usuario modificado satisfactoriamente"]);

        $userUpdated = User::query()->where('id', $user[0]->id)->first();
        $this->assertEquals("David", $userUpdated->name);
    }
}
