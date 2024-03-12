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
                        if($this->lang == 'en') {
                            $fail('Invalid token');
                        }else{
                            $fail('Неверный токен');
                        }
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
                        if($this->lang == 'en'){
                            $fail('Password mismatch');
                        }else {
                            $fail('Пароли не совпадают');
                        }
                    }
                }
            ],
            'lang' => 'nullable'
        ];
    }

    public function messages(): array
    {
        if($this->lang == 'en'){
            return [
                'token.required' => 'Token is not specified',
                'token.string' => 'Token must be a string',
                'token.exists' => 'Invalid token',

                'email.required' => 'Email is not specified',
                'email.email' => 'Invalid email format',
                'email.exists' => 'User not found',

                'password.required' => 'Specify a password',
                'password.string' => 'Password must be a string',
                'password.min' => 'Password must contain at least 8 characters',

                're_password.required' => 'Repeat the password',
                're_password.string' => 'Repeated password must be a string'
            ];
        }else{
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
}
