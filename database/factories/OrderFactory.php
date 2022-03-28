<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'reference' => strtoupper(substr(md5(uniqid(rand(), true)), 0, 8)),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'document_type' => 'citizenship_id',
            'document_number' => strval($this->faker->numberBetween(10000000, 99999999)),
            'email' => $this->faker->safeEmail(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'postcode' => strval(rand(100000, 999999)),
            'phone' => strval($this->faker->numberBetween(1000000000, 9999999999)),
            'notes' => $this->faker->text(255),
        ];
    }
}
