<?php

namespace Tests\Feature\Api\Admin\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    protected $endPoint = '/api/admin/categories';

    public function test_error_not_found_when_try_to_update_unknown_categories(): void
    {
        $response = $this->putJson($this->endPoint . '/1/status/active');
        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => __('general.api.exceptions.model_not_found')]);
    }

    public function test_error_when_try_to_update_category_with_wrong_status(): void
    {
        $category = Category::factory(1)->create();
        $response = $this->putJson($this->endPoint . '/' . $category[0]->id . '/status/ready');
        $response->assertStatus(422);
        $response->assertJsonFragment(['status' =>[__('validation.in', ['attribute' => 'status'])]]);
    }

    public function test_change_status_to_active_for_an_inactive_category(): void
    {
        $data = [
            'name_en' => 'Computers',
            'name_es' => 'Computadores',
            'type' => 'category',
            'icon' => 'fa fas-question',
            'status' => 'inactive',
        ];

        $category = Category::factory(1)->create($data);
        $response = $this->putJson($this->endPoint . '/' . $category[0]->id . '/status/active');
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.category.update_status_success')]);

        $categoryUpdated = Category::query()->where('id', $category[0]->id)->first();
        $this->assertEquals('active', $categoryUpdated->status);
    }

    public function test_change_status_to_inactive_for_an_active_category(): void
    {
        $category = Category::factory(1)->create(['status' => 'active']);
        $response = $this->putJson($this->endPoint . '/' . $category[0]->id . '/status/inactive');
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.category.update_status_success')]);

        $categoryUpdated = Category::query()->where('id', $category[0]->id)->first();
        $this->assertEquals('inactive', $categoryUpdated->status);
    }
}
