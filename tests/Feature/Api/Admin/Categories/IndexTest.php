<?php

namespace Tests\Feature\Api\Admin\Categories;

use App\Models\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use UserApiFaker;
    use RequestFaker;
    use RefreshDatabase;

    protected $endPoint = '/api/admin/categories';

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

    public function test_check_categories_empty(): void
    {
        $response = $this->get($this->endPoint, $this->headers);
        $this->assertCount(0, $response->json()['categories']['data']);
    }

    public function test_check_all_categories(): void
    {
        Category::factory(3)->create();

        $response = $this->get($this->endPoint, $this->headers);
        $this->assertCount(3, $response->json()['categories']['data']);
    }
}
