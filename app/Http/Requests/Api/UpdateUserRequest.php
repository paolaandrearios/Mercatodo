<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __( 'validation.required'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['id' => $this->route('user')]);
    }
}
