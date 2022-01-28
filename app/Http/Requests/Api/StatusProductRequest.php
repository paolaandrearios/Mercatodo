<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StatusProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'in:active,inactive',
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['status' => $this->route('status')]);
    }
}
