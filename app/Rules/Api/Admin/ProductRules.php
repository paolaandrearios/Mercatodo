<?php

namespace App\Rules\Api\Admin;

class ProductRules implements Rules
{
    public static function toArray(): array
    {
        return [
            'sku' => [
                'required',
                'unique:products',
                'alpha_num',
                'min:5',
                'max:10',
            ],
            'name_es' => [
                'required',
                'unique:products',
                'min:4',
                'max:60',
            ],
            'name_en' => [
                'required',
                'unique:products',
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
            'images.*' => [
                'image',
                'mimes:jpg,bmp,png',
            ],
            'price' => [
                'required',
                'regex:/^\d*(\.\d{2})?$/',
                'max:13',
                'gt:0',
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
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
                'min:0',
            ],
        ];
    }
}
