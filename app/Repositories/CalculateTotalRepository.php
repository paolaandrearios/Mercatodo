<?php


namespace App\Repositories;


class CalculateTotalRepository
{

    public function calculateTotal(float $price, float $tax, int $quantity): array
    {
        $taxesAccum = $price * $tax/100 * $quantity;
        $subtotalAccum = $price * (1 - $tax/100) * $quantity;
        $total = $taxesAccum + $subtotalAccum;

        return array($taxesAccum, $subtotalAccum, $total);
    }

}
