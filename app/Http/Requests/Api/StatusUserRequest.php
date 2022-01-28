<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StatusUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'exists:users,id',
            ],
            'status' => [
                'required',
                'in:active,inactive',
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['id' => $this->route('user')]);
        $this->merge(['status' => $this->route('status')]);
    }
}
