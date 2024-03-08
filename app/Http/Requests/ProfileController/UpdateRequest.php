<?php

namespace App\Http\Requests\ProfileController;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'old_password' => [
                'nullable',
                'string',
                function(string $attribute, mixed $value, Closure $fail){
                    if(!Hash::check($value, Auth()->user()->password)){
                        //$fail('Указан неверный пароль');
                    }
                }
            ],
            'new_password' => 'nullable|string|min:8'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя',
            'name.string' => 'Имя должно быть строкой',

            'email.required' => 'Введите email',
            'email.email' => 'Неверный формат email',

            'old_password.string' => 'Текущий пароль должен быть строкой',

            'new_password.string' => 'Новый пароль должен быть строкой',
            'new_password.min' => 'Новый пароль должен быть не меньше 8 символов'
        ];
    }
}
