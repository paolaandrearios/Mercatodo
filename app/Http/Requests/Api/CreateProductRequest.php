<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'sku' => 'required|unique:products|alpha_num|min:5|max:10',
            'name_es' => 'required|unique:products|min:10|max:60',
            'name_en' => 'required|unique:products|min:10|max:60',
            'description_en' => 'required|min:80|max:400',
            'description_es' => 'required|min:80|max:400',
            'image' => 'required|image|mimes:jpg,bmp,png',
            'price' => 'required|regex:/^\d*(\.\d{2})?$/|max:13',
            'category' => 'required',
            'status' => 'required|in:active,inactive',
            'taxes' => 'required|integer|digits_between:1,10',
            'stock' => 'required|integer',
        ];
    }
}
