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
            'email' => 'required|exists:users,email',
            'lang' => 'nullable'
        ];
    }

    public function messages(): array
    {
        if($this->lang == 'en'){
            return [
                'email.required' => 'Enter your email',
                'email.exists' => 'User with this email not found'
            ];
        }else {
            return [
                'email.required' => 'Введите email',
                'email.exists' => 'Пользователь с таким email не найден'
            ];
        }
    }
}
