<?php

namespace App\Http\Requests\Api;

use App\Rules\Api\Admin\NameCategoryRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name_es' => [
                'required',
                new NameCategoryRule($this->route('category')),
                'min:4',
                'max:60',
            ],
            'name_en' => [
                'required',
                new NameCategoryRule($this->route('category')),
                'min:4',
                'max:60',
            ],
            'type' => [
                'required',
                'in:category,subcategory',
            ],

            'icon' => [
                'required',
                'min:5',
            ],
        ];

        if ($this->has('outstanding_image')) {
            $rules['outstanding_image'] = ['image', 'mimes:jpg,bmp,png'];
        }

        return $rules;
    }
}
