<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'sku' => $this->faker->unique()->password(5,6),
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->text(),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2,25000,100000),
            'category' => $this->faker->sentence(2),
            'taxes' => '19',
            'stock' => $this->faker->randomDigitNot(0),
            'slug' => $this->faker->slug(),
        ];
    }
}
