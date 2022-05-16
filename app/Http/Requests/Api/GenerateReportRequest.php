<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GenerateReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'initial-date' => [
                'required',
                'date'
            ],
            'end-date' => [
                'required',
                'date'
            ],
            'report-option' => [
                'required',
                'in:most_visited,least_visited,best_selling_products,least_sold_products,abandoned_carts,best_selling_categories'
            ],
        ];
    }
}
