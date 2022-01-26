<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name_es' => $this->faker->sentence(),
            'name_en' => $this->faker->sentence(),
            'outstanding_image' => $this->faker->imageUrl(),
            'slug' => $this->faker->slug(),
        ];
    }
}
