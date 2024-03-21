<?php

namespace App\Http\Requests\Front\AuthController;

use App\Models\User;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => [
                'required',
                'string',
                function(string $attribute, mixed $value, Closure $fail): void
                {
                    $user = User::where('email', $this->email)->first();
                    if(!$user || !Hash::check($value, $user->password) || !$user->is_admin){
                        $fail('Неверный email или пароль');
                    }
                }
            ],
            'remember' => 'nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Введите email',
            'email.email' => 'Неверный формат email',
            'email.exists' => 'Пользователь с таким email не найден',

            'password.required' => 'Введите пароль',
            'password.string' => 'Пароль должен быть строкой'
        ];
    }
}
