<?php

namespace App\Rules\Api\Admin;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class NameProductRule implements Rule
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function passes($attribute, $value): bool
    {
        $count = Product::where($attribute, $value)
            ->where('id', '!=', $this->product->id)
            ->count();
        if ($count === 0) {
            return true;
        }

        return false;
    }

    public function message(): string
    {
        return __('general.api.product.name_product_rule_message');
    }
}
