<?php

namespace Tests\Feature\Api\Admin\Products;

use App\Models\Category;
use App\Models\Product;
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

    protected $endPoint = '/api/admin/products';

    public function test_error_401_when_user_is_unauthenticated(): void
    {
        $response = $this->get($this->endPoint, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);
        $response->assertStatus(401);
    }

    public function test_create_product(): void
    {
        $category = Category::factory(1)->create(['status' => 'active'])->first();
        $data = [
            'sku' => '123456',
            'name_es' => 'Producto Prueba',
            'name_en' => 'Test product',
            'description_en' => 'This is a short description, This is a short description, This is a short description, This is a short description',
            'description_es' => 'Esta es una corta descripcion, Esta es una corta descripcion,Esta es una corta descripcion, Esta es una corta descripcion',
            'image'  => new UploadedFile(resource_path('test-files/nueva-categoria.jpg'), 'nueva-categoria.jpg', null, null, true),
            'price' => '500000',
            'category_id' => [$category->id],
            'taxes' => '19',
            'stock' => 10,
            'slug' => '/slug',
            'status' => 'active',
        ];

        $response = $this->postJson($this->endPoint, $data, $this->headers);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.product.create_status_success')]);

        $productCreated = Product::query()->where('id', $response->json()['product']['id'])->first();
        $this->assertEquals('Producto Prueba', $productCreated->name_es);
        $this->assertEquals('Test product', $productCreated->name_en);
    }
}
