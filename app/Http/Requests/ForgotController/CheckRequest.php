<?php

namespace App\Http\Requests\ForgotController;

use Illuminate\Foundation\Http\FormRequest;

class CheckRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'token' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email не указан',
            'email.string' => 'Email должен быть строкой',
            'token.required' => 'Токен не указан',
            'token.string' => 'Токен должен быть строкой'
        ];
    }
}
