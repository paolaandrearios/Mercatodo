<?php

namespace App\Http\Requests\Api;

use App\Rules\Api\Admin\ProductRules;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ProductRules::toArray();
    }
}
