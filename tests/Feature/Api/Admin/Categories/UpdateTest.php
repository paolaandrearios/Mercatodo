<?php

namespace Tests\Feature\Api\Admin\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
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

    public function test_error_not_found_when_try_to_update_unknown_category(): void
    {
        $response = $this->putJson($this->endPoint . '/1', ['name_en' => 'test'], $this->headers);
        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => __('general.api.exceptions.model_not_found')]);
    }

    public function test_update_existent_category(): void
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

        $UpdatedData = [
            'name_es' => 'Deporte',
            'name_en' => 'Sport',
            'slug' => '/slug',
            'type' => 'category',
            'icon' => 'fa fas-question',
            'status' => 'active',
        ];

        $category = Category::factory(1)->create($data);

        $response = $this->putJson($this->endPoint . '/' . $category[0]->id, $UpdatedData, $this->headers);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.category.update_status_success')]);

        $categoryUpdated = Category::query()->where('id', $category[0]->id)->first();
        $this->assertEquals('Sport', $categoryUpdated->name_en);
    }
}
