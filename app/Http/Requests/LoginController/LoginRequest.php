<?php

namespace App\Http\Requests\LoginController;

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
            'lang' => 'nullable',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                function(string $attribute, mixed $value, Closure $fail): void {
                    $user = User::where('email', $this->email);
                    if(!$user->exists() || !Hash::check($value, $user->pluck('password')->first())){
                        if($this->lang == 'en'){
                            $fail('Incorrect Email or Password');
                        }else {
                            $fail('Неверный Email или пароль');
                        }
                    }
                }
            ],
            'remember' => 'nullable'
        ];
    }

    public function messages(): array
    {
        if($this->lang == 'en'){
            return [
                'email.required' => 'Enter email',
                'email.email' => 'Invalid email format',

                'password.required' => 'Enter password',
                'password.string' => 'Password must be a string'
            ];
        } else {
            return [
                'email.required' => 'Введите email',
                'email.email' => 'Неверный формат email',

                'password.required' => 'Введите пароль',
                'password.string' => 'Пароль должен быть строкой'
            ];
        }
    }
}
