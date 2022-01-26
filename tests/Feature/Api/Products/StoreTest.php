<?php

namespace Tests\Feature\Api\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected $endPoint = '/api/products';

    //TODO: enable this when I implement form request
    /*    public function test_validation_errors_when_try_to_create_product(): void
        {
            $response = $this->putJson($this->endPoint . '/1', ['name_en' => 'test']);
            $response->assertStatus(422);
            $response->assertJsonFragment(['id' =>['The selected id is invalid.']]);
        }*/

    public function test_create_product(): void
    {
        $category = Category::factory(1)->create(['status' => 'active']);
        $data =  [
            'sku' => '123456',
            'name' => 'Test product',
            'description' => 'description',
            'image'  => new UploadedFile(resource_path('test-files/nueva-categoria.jpg'), 'nueva-categoria.jpg', null, null, true),
            'price' => '500000',
            'category' => [$category->id],
            'taxes' => '19',
            'stock' => 10,
            'slug' => '/slug',
        ];

        $response = $this->postJson($this->endPoint, $data);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.product.create_status_success')]);

        $productCreated = Product::query()->where('id', $response->json()['product']['id'])->first();
        $this->assertEquals('Test product', $productCreated->name);
    }
}
