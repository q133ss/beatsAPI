<?php

namespace App\Http\Requests\ForgotController;

use Illuminate\Foundation\Http\FormRequest;

class ForgotRequest extends FormRequest
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
            'email' => 'required|exists:users,email'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Введите email',
            'email.exists' => 'Пользователь с таким email не найден'
        ];
    }
}
