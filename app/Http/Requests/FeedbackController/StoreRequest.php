<?php

namespace App\Http\Requests\FeedbackController;

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
            'theme' => 'required|string',
            'message' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'theme.required' => 'Введите тему',
            'theme.string' => 'Тема должна быть строкой',

            'message.required' => 'Введите сообщение',
            'message.string' => 'Сообщение должно быть строкой'
        ];
    }
}
