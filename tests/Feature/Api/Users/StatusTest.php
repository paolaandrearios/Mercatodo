<?php

namespace Tests\Feature\Api\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase ;

    protected $endPoint = '/api/users';

    public function test_error_not_found_when_try_to_update_unknown_user(): void
    {
        $response = $this->putJson($this->endPoint . '/1/status/active');
        $response->assertStatus(422);
        $response->assertJsonFragment(["id" =>["The selected id is invalid."]]);
    }

    public function test_error_when_try_to_update_user_with_wrong_status(): void
    {
        $user = User::factory(1)->create();
        $response = $this->putJson($this->endPoint . '/'.$user[0]->id.'/status/ready');
        $response->assertStatus(422);
        $response->assertJsonFragment(["status" =>["The selected status is invalid."]]);
    }

    public function test_change_status_to_active_for_an_inactive_user(): void
    {
        $user = User::factory(1)->create(['status' => 'inactive']);
        $response = $this->putJson($this->endPoint . '/'.$user[0]->id.'/status/active');
        $response->assertOk();
        $response->assertJsonFragment(["message" => "Usuario modificado satisfactoriamente"]);

        $userUpdated = User::query()->where('id', $user[0]->id)->first();
        $this->assertEquals("active", $userUpdated->status);
    }

    public function test_change_status_to_inactive_for_an_active_user(): void
    {
        $user = User::factory(1)->create(['status' => 'active']);
        $response = $this->putJson($this->endPoint . '/'.$user[0]->id.'/status/inactive');
        $response->assertOk();
        $response->assertJsonFragment(["message" => "Usuario modificado satisfactoriamente"]);

        $userUpdated = User::query()->where('id', $user[0]->id)->first();
        $this->assertEquals("inactive", $userUpdated->status);
    }

//    public function test_update_existent_user():void
//    {
//        $user = User::factory(1)->create(['name' => 'Josh']);
//
//        $response = $this->putJson($this->endPoint . '/' . $user[0]->id, ['name' => 'David']);
//        $response->assertOk();
//        $response->assertJsonFragment(["message" => "Usuario modificado satisfactoriamente"]);
//
//        $userUpdated = User::query()->where('id', $user[0]->id)->first();
//        $this->assertEquals("David", $userUpdated->name);
//    }
}
