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

        $response = $this->postJson($this->endPoint, $data);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.category.create_status_success')]);

        $categoryCreated = Category::query()->where('id', $response->json()['category']['id'])->first();
        $this->assertEquals('Technology', $categoryCreated->name_en);
    }
}
