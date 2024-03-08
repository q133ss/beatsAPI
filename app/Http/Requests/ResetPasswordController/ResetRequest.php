<?php

namespace App\Http\Requests\ResetPasswordController;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ResetRequest extends FormRequest
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
            'token' => [
                'required',
                'string',
                'exists:password_resets,token',
                function(string $attribute, mixed $value, Closure $fail) : void
                {
                    if(!DB::table('password_resets')
                        ->where('email', $this->email)
                        ->where('token', $value)
                        ->exists())
                    {
                        $fail('Неверный токен');
                    }
                }
            ],
            'email' => [
                'required',
                'email',
                'exists:users,email'
            ],
            'password' => 'required|string|min:8',
            're_password' => [
                'required',
                'string',
                function(string $attribute, mixed $value, Closure $fail) : void
                {
                    if($value != $this->password){
                        $fail('Пароли не совпадают');
                    }
                }
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'Токен не указан',
            'token.string' => 'Токен должен быть строкой',
            'token.exists' => 'Неверный токен',

            'email.required' => 'Email не указан',
            'email.email' => 'Неверный формат Email',
            'email.exists' => 'Пользователь не найден',

            'password.required' => 'Укажите пароль',
            'password.string' => 'Пароль должен быть строкой',
            'password.min' => 'Пароль должен содержать, как минимум 8 символов',

            're_password.required' => 'Повторите пароль',
            're_password.string' => 'Повторный пароль должен быть строкой'
        ];
    }
}
