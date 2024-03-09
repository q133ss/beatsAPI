<?php

namespace App\Http\Requests\PayController;

use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
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
            'type' => 'required|string|in:ukassa',
            'sum' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Выберите платежную систему',
            'type.string' => 'Ошибка #1',
            'type.in' => 'Ошибка #2',

            'sum.required' => 'Неверная сумма',
            'sum.numeric' => 'Неверный формат суммы'
        ];
    }
}
