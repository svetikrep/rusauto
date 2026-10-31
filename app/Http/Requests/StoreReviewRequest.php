<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author_name' => ['required', 'string', 'min:2', 'max:100'],
            'comment' => ['required', 'string', 'min:5', 'max:1000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'author_name.required' => 'Укажите ваше имя для отзыва.',
            'author_name.min' => 'Имя должно содержать не менее 2 символов.',
            'comment.required' => 'Пожалуйста, напишите ваш отзыв.',
            'comment.min' => 'Текст отзыва должен содержать не менее 5 символов.',
            'comment.max' => 'Текст отзыва не может превышать 1000 символов.',
            'rating.required' => 'Пожалуйста, выберите оценку.',
            'rating.between' => 'Оценка должна быть от 1 до 5 звезд.',
        ];
    }
}
