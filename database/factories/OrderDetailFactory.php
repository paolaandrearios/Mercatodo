<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => rand(1, 4),
            'order_id' => 1,
            'quantity' => $this->faker->numberBetween($min = 1, $max = 20),
            'taxes' => $this->faker->numberBetween(10000, 99999),
            'subtotal' => $this->faker->numberBetween(100000, 999999),
            'total' => $this->faker->numberBetween(100000, 999999),
        ];
    }
}
