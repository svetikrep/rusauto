<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'phone' => ['required', 'string', 'regex:/^(\+7|7|8)?[\s\-]?\(?[0-9]{3}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/'],
            'car_id' => ['nullable', 'exists:cars,id'],
            'message' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Пожалуйста, укажите ваше имя.',
            'name.min' => 'Имя должно содержать минимум 2 символа.',
            'name.max' => 'Имя не должно превышать 100 символов.',
            'phone.required' => 'Пожалуйста, введите ваш контактный номер телефона.',
            'phone.regex' => 'Некорректный формат телефона. Пример: +7 (999) 123-45-67',
            'car_id.exists' => 'Выбранный автомобиль не найден в базе данных.',
            'message.max' => 'Комментарий не может быть длиннее 1000 символов.',
        ];
    }
}
