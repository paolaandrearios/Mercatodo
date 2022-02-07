<?php

namespace App\Rules\Api\Client;

use Illuminate\Contracts\Validation\Rule;

class SearchProductRule implements Rule
{
    private $characters;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function passes($attribute, $value): bool
    {
        $characters = strlen($value);
        $minCharacters = 4;

        if ($characters === 0) {
            return true;
        } else {
            if ($characters >= $minCharacters) {
                return true;
            }

            return false;
        }
    }

    public function message(): string
    {
        return __('general.api.product.characters_number_product_rule_message');
    }
}
