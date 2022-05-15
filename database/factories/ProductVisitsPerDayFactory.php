<?php

namespace Database\Factories;

use App\Models\ProductVisitsPerDay;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVisitsPerDayFactory extends Factory
{
    protected $model = ProductVisitsPerDay::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'count' => rand(1, 100),
            'date' => date('Y-m-d'),
            'product_id' => 1,
        ];
    }
}
