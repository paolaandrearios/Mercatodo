<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'id' => 'required|exists:users,id',
            'name' => 'required',
            'document_type' => ['required', 'in:CC,CE,NIT'],
            'document_number' => ['required', 'numeric'],
            'address' => ['required'],
            'city' => ['required'],
            'phone' => ['required', 'numeric'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
        ];
    }

    /**
     *
     */
    protected function prepareForValidation(): void
    {
        $this->merge(['id' => $this->route('user')]);
    }
}
