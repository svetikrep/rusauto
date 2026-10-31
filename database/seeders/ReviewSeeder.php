<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'author_name' => 'Алексей Смирнов',
                'comment' => 'Отличный автосалон! Грамотные консультанты, помогли с выбором и быстро оформили все документы. Рекомендую!',
                'rating' => 5,
                'is_published' => true,
            ],
            [
                'author_name' => 'Екатерина Воронова',
                'comment' => 'Большой выбор, приятные цены и отличный сервис. Рекомендую!',
                'rating' => 5,
                'is_published' => true,
            ],
            [
                'author_name' => 'Михаил Д.',
                'comment' => 'Спасибо команде салона за профессионализм. Всё четко, прозрачно и по делу. 5 звезд!',
                'rating' => 5,
                'is_published' => true,
            ],
            [
                'author_name' => 'Сергей К.',
                'comment' => 'Отдельное спасибо менеджеру за терпение и подробный тест-драйв. Обслуживание на высшем уровне!',
                'rating' => 5,
                'is_published' => true,
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
