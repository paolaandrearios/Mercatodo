<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'reference' => strtoupper(substr(md5(uniqid(rand(), true)),0,8)),
            'total' => $this->faker->numerify('######'),
            'status' => 'pending',
            'url' => $this->faker->url(),
            'session' => '{"status":{"status":"OK","reason":"PC","message":"The request has been processed correctly",
                         "date":"2022-03-27T11:35:39-05:00"},"requestId":51465,"processUrl":"https:\/\/checkout-co.placetopay.dev\/session\/51465\/0c78b064983d38a2b49949a103512899"}',
        ];
    }
}
