<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ExportProductRequest extends FormRequest
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
                'date',
            ],
            'end-date' => [
                'required',
                'date',
                'after:initial-date',
            ],
        ];
    }
}
