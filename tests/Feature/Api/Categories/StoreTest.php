<?php

namespace Tests\Feature\Api\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected $endPoint = '/api/categories';


    public function test_error_not_found_when_try_to_create_category(): void
    {
        $response = $this->putJson($this->endPoint . '/1', ['name_en' => 'test']);
        $response->assertStatus(422);
        $response->assertJsonFragment(['id' =>['The selected id is invalid.']]);
    }

    public function test_create_category(): void
    {
        $data = [
            'name_es' => 'Tabletas',
            'name_en' => 'Tablets',
            'outstanding_image' => new UploadedFile(resource_path('test-files/nueva-categoria.jpg'), 'nueva-categoria.jpg', null, null, true),
            'slug' => '/slug',
        ];
        $response = $this->postJson($this->endPoint, $data);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.category.create_status_success')]);

        $categoryCreated = Category::query()->where('id', $response->json()['category']['id'])->first();
        $this->assertEquals('Tablets', $categoryCreated->name_en);
    }
}
