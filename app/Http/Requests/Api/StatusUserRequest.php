<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StatusUserRequest extends FormRequest
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
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     *
     */
    protected function prepareForValidation(): void
    {
        $this->merge(['id' => $this->route('user')]);
        $this->merge(['status' => $this->route('status')]);
    }
}
