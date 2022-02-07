<?php

namespace App\Http\Requests\Api;

use App\Rules\Api\Client\SearchProductRule;
use Illuminate\Foundation\Http\FormRequest;

class SearchProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'keyword' => [
                new SearchProductRule(),
                'max:30',
            ],
        ];
    }
}
