<?php

namespace App\Http\Requests\RegisterController;

use Closure;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'lang' => 'nullable',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            're_password' => [
                'required',
                'string',
                function(string $attribute, mixed $value, Closure $fail): void{
                    if($this->password != $value){
                        if($this->lang == 'en'){
                            $fail('Password mismatch');
                        }else {
                            $fail('Пароли не совпадают');
                        }
                    }
                }
            ]
        ];
    }

    public function messages(): array
    {
        if($this->lang == 'en'){
            return [
                'name.required' => 'Enter your name',
                'name.string' => 'Name must be a string',
                'email.required' => 'Enter your email',
                'email.email' => 'Invalid email format',
                'email.unique' => 'User with this email already exists',
                'password.required' => 'Enter your password',
                'password.string' => 'Password must be a string',
                'password.min' => 'Password must be at least 8 characters long',
                're_password.required' => 'Repeat your password',
                're_password.string' => 'Repeat password must be a string'
            ];
        }else {
            return [
                'name.required' => 'Введите имя',
                'name.string' => 'Имя должно быть строкой',
                'email.required' => 'Введите email',
                'email.email' => 'Неверный формат email',
                'email.unique' => 'Пользователь с таким email уже существует',
                'password.required' => 'Введите пароль',
                'password.string' => 'Пароль должен быть строкой',
                'password.min' => 'Пароль должен содержать не менее 8 символов',
                're_password.required' => 'Повторите пароль',
                're_password.string' => 'Повторный пароль должен быть строкой'
            ];
        }
    }
}
