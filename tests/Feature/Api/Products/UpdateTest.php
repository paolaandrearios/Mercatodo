<?php

namespace Tests\Feature\Api\Products;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected $endPoint = '/api/categories';

    //TODO: enable this when I implement form request
/*    public function test_error_not_found_when_try_to_update_unknown_category(): void
    {
        $response = $this->putJson($this->endPoint . '/1', ['name_en' => 'test']);
        $response->assertStatus(422);
        $response->assertJsonFragment(['id' =>['The selected id is invalid.']]);
    }*/

    public function test_update_existent_category(): void
    {
        $category = Category::factory(1)->create(['name_en' => 'Tablets']);

        $response = $this->putJson($this->endPoint . '/' . $category[0]->id, ['name_en' => 'Computers']);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.category.update_status_success')]);

        $categoryUpdated = Category::query()->where('id', $category[0]->id)->first();
        $this->assertEquals('Computers', $categoryUpdated->name_en);
    }
}
