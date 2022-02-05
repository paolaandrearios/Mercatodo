<?php

namespace Tests\Feature\Api\Products;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected $endPoint = '/api/categories';


    public function test_error_not_found_when_try_to_update_unknown_category(): void
    {
        $response = $this->putJson($this->endPoint . '/1', ['name_en' => 'test']);
        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => __('general.api.exceptions.model_not_found')]);
    }

    public function test_update_existent_category(): void
    {
        $category = Category::factory(1)
            ->create(
                [
                    'name_en' => 'Tablets',
                    'name_es' => 'Tabletas',
                    'type' => 'category',
                    'icon' => 'fa fas-question',
                ]);

        $data = [
            'name_en' => 'Computers',
            'name_es' => 'Computadores',
            'type' => 'category',
            'icon' => 'fa fas-question',
        ];

        $response = $this->putJson($this->endPoint . '/' . $category[0]->id, $data);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.category.update_status_success')]);

        $categoryUpdated = Category::query()->where('id', $category[0]->id)->first();
        $this->assertEquals('Computers', $categoryUpdated->name_en);
        $this->assertEquals('Computadores', $categoryUpdated->name_es);
    }
}
