<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shipping.first_name' => [
                'required',
                'string',
                'min:3',
                'max:20',
            ],
            'shipping.last_name' => [
                'required',
                'string',
                'min:3',
                'max:20',
            ],
            'shipping.document_type' => [
                'required',
                'in:citizenship_id,foreigner_id,passport'
            ],
            'shipping.document_number' => [
                'required',
                'string',
                'min:8',
                'max:10',
            ],
            'shipping.email' => [
                'required',
                'string',
                'email',
                'max:40',
            ],
            'shipping.address' => [
                'required',
                'string',
                'min:10',
                'max:100',
            ],
            'shipping.city' => [
                'required',
                'string',
                'min:3',
                'max:30',
            ],
            'shipping.postcode' => [
                'required',
                'string',
                'size:6',
            ],
            'shipping.phone' => [
                'required',
                'string',
                'size:10',
            ],
            'shipping.notes' => [
                'string',
                'max:255',
                'nullable',
            ],
        ];
    }
}
