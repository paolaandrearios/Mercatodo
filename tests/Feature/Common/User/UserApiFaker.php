<?php

namespace Tests\Feature\Common\User;


use App\Models\User;
use Laravel\Sanctum\Sanctum;

trait UserApiFaker
{
    protected $userConfig = null;
    protected $headers = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userConfig = $this->getUserAndToken();
        $this->headers = $this->getApiHeaders($this->userConfig['token']);
    }

    public function getUserAndToken(): array
    {
        $user = Sanctum::actingAs(User::factory()->create(), [], 'api');
        $token = $user->createToken('token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token,
        ];
    }



}
