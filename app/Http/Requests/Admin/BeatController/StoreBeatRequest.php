<?php

namespace App\Http\Requests\Admin\BeatController;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeatRequest extends FormRequest
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
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'price' => 'required|integer',
            'demo_file' => 'required|file',
            'full_file' => 'required|file'
        ];
    }

    public function messages(): array
    {
        return [
            'author_id.required' => 'Поле "автор" обязательно для заполнения.',
            'author_id.exists' => 'Выбранного автора не существует.',
            'category_id.required' => 'Поле "категория" обязательно для заполнения.',
            'category_id.exists' => 'Выбранной категории не существует.',
            'name.required' => 'Поле "Название" обязательно для заполнения.',
            'name.string' => 'Поле "Название" должно быть строкой.',
            'price.required' => 'Поле "Цена" обязательно для заполнения.',
            'price.integer' => 'Поле "Цена" должно быть целым числом.',
            'demo_file.required' => 'Поле "Демо-файл" обязательно для заполнения.',
            'demo_file.file' => 'Поле "Демо-файл" должно быть файлом.',
            'full_file.required' => 'Поле "Полный файл" обязательно для заполнения.',
            'full_file.file' => 'Поле "Полный файл" должно быть файлом.'
        ];
    }
}
