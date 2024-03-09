<?php

namespace App\Http\Requests\Admin\UserController;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $this->user->id,
            'password' => 'string|min:8|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Поле "Имя" должно быть строкой.',
            'name.max' => 'Поле "Имя" не должно превышать 255 символов.',
            'email.string' => 'Поле "Email" должно быть строкой.',
            'email.email' => 'Поле "Email" должно быть валидным email адресом.',
            'email.unique' => 'Пользователь с таким "Email" уже существует.',
            'email.max' => 'Поле "Email" не должно превышать 255 символов.',
            'password.string' => 'Поле "Пароль" должно быть строкой.',
            'password.min' => 'Пароль должен содержать не менее 8 символов.',
            'password.max' => 'Поле "Пароль" не должно превышать 255 символов.',
        ];
    }
}
