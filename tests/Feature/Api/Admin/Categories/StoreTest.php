<?php

namespace Tests\Feature\Api\Admin\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use UserApiFaker;
    use RequestFaker;

    protected $endPoint = '/api/admin/categories';

    public function test_error_401_when_user_is_unauthenticated(): void
    {
        $response = $this->get($this->endPoint, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);
        $response->assertStatus(401);
    }

    public function test_create_category(): void
    {
        $data = [
            'name_es' => 'Tecnologia',
            'name_en' => 'Technology',
            'outstanding_image' => new UploadedFile(resource_path('test-files/nueva-categoria.jpg'), 'nueva-categoria.jpg', null, null, true),
            'slug' => '/slug',
            'type' => 'category',
            'icon' => 'fa fas-question',
            'status' => 'active',
        ];

        $response = $this->postJson($this->endPoint, $data, $this->headers);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.category.create_status_success')]);

        $categoryCreated = Category::query()->where('id', $response->json()['category']['id'])->first();
        $this->assertEquals('Technology', $categoryCreated->name_en);
    }
}
