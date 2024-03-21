<?php

namespace App\Http\Requests\ApplicationController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|min:11'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя',
            'name.string' => 'Имя должно быть строкой',
            'name.max' => 'Поле имя не может быть больше 255 символов',

            'phone.required' => 'Введите телефон',
            'phone.string' => 'Телефон должен быть строкой',
            'phone.max' => 'Поле телефон не может быть больше 255 символов',
            'phone.min' => 'Поле телефон не может быть меньше 11 символов',
        ];
    }
}
