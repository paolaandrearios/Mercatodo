<?php

namespace App\Http\Requests\Api;

use App\Rules\Api\Admin\NameProductRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $rules = [
            'sku' => [
                'required',
                new NameProductRule($this->route('product')),
                'alpha_num',
                'min:5',
                'max:10',
            ],
            'name_es' => [
                'required',
                new NameProductRule($this->route('product')),
                'min:4',
                'max:60',
            ],
            'name_en' => [
                'required',
                new NameProductRule($this->route('product')),
                'min:4',
                'max:60',
            ],
            'description_en' => [
                'required',
                'min:80',
                'max:400',
            ],
            'description_es' => [
                'required',
                'min:80',
                'max:400',
            ],
            'price' => [
                'required',
                'regex:/^\d*(\.\d{2})?$/',
                'max:13',
            ],
            'category' => [
                'required'
            ],
            'status' => [
                'required',
                'in:active,inactive',
            ],
            'taxes' => [
                'required',
                'integer',
                'digits_between:1,10',

            ],
            'stock' => [
                'required',
                'integer',
            ],
        ];

        if($this->has('image')){
            $rules['image'] = ['image', 'mimes:jpg,bmp,png' ];
        }

        return $rules;
    }
}
