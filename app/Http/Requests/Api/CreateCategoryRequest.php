<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name_es' => 'required|unique:categories|min:10|max:60',
            'name_en' => 'required|unique:categories|min:10|max:60',
            'outstanding_image' => 'required|image|mimes:jpg,bmp,png',
            'type' => 'required|in:category,subcategory',
            'status' => 'required|in:active,inactive',
            'icon' => 'required|min:10',
        ];
    }
}
