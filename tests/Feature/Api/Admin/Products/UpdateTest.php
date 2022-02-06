<?php

namespace Tests\Feature\Api\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected $endPoint = '/api/admin/products';


    public function test_error_not_found_when_try_to_update_unknown_product(): void
    {
        $response = $this->putJson($this->endPoint . '/1', ['name_en' => 'test']);
        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => __('general.api.exceptions.model_not_found')]);
    }

    public function test_update_existent_product(): void
    {
        $category = Category::factory(1)->create()->first();
        $product = Product::factory(1)
            ->create(
                [
                    "sku" => "47880868",
                    'name_es' => 'Computador Hp',
                    'name_en' => 'Hp computer',
                    'description_es' => 'Computador Hp 200 G4 Todo en Uno 4GB Intel Pentium J5040',
                    'description_en' => 'Computer Hp 200 G4 All in One 4GB Intel Pentium J5040',
                    'price' => '2500000',
                    'status' => 'active',
                    'stock' => '3',
                    'taxes' => '19',
                ])->first();
        $data = [
            'sku' => "57880868",
            'name_es' => 'Computador Lenovo',
            'name_en' => 'Lenovo Computer',
            'description_es' => 'Procesador Intel Core i3 1005G1 (4 MB cache 1,2 hasta 3,4 GHZ), Memoria  4GB DDR4-2400, Disco duro de 256 SSD M.2 PCIE y Monitor 14 pulgadas HD (1366 x 768) TN 220 NITS Antirreflejo',
            'description_en' => 'Intel Core i3 1005G1 processor (4 MB cache 1.2 up to 3.4 GHZ), 4GB DDR4-2400 memory, 256 SSD M.2 PCIE hard drive and 14-inch HD (1366 x 768) TN 220 NITS Anti-glare monitor',
            'price' => '2000000',
            'categoryId' => $category->id,
            'status' => 'active',
            'stock' => '3',
            'taxes' => '19',
        ];

        $response = $this->putJson($this->endPoint . '/' . $product->id, $data);
        $response->assertOk();
        $response->assertJsonFragment(['message' => __('general.api.product.update_status_success')]);

        $productUpdated = Product::query()->where('id', $product->id)->first();
        $this->assertEquals('Lenovo Computer', $productUpdated->name_en);
        $this->assertEquals('Computador Lenovo', $productUpdated->name_es);
    }
}
