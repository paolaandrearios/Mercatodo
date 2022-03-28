<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'sku' => rand(10000, 999999),
            'name_en' => $this->faker->sentence(2),
            'description_en' => $this->faker->text(200),
            'name_es' => $this->faker->sentence(2),
            'description_es' => $this->faker->text(200),
            'price' => $this->faker->randomFloat(2, 25000, 100000),
            'taxes' => '19',
            'stock' => $this->faker->randomDigitNot(0),
            'slug' => $this->faker->slug(),
            'status' => 'active',
        ];
    }
}
