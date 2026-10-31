<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            [
                'title' => 'Audi Q5 L III (GU)',
                'brand' => 'Audi',
                'model' => 'Q5 L',
                'slug' => 'audi-q5-l-iii-gu',
                'year' => 2026,
                'price' => 6150000,
                'badge' => 'Новинка',
                'image' => 'img/catalog-car.png',
                'mileage' => '0 км (Новый)',
                'engine' => '2.0 л (245 л.с.) TFSI',
                'transmission' => '7-ступенчатый S tronic',
                'drive' => 'Полный (quattro)',
                'color' => 'Красный металлик',
                'description' => 'Премиальный удлиненный кроссовер нового поколения Audi Q5 L. Непревзойденный комфорт для пассажиров заднего ряда, матричные фары HD Matrix LED, виртуальная панель приборов Audi virtual cockpit plus и адаптивная подвеска.',
                'is_available' => true,
            ],
            [
                'title' => 'Audi RS6 Avant Performance',
                'brand' => 'Audi',
                'model' => 'RS6',
                'slug' => 'audi-rs6-avant-performance',
                'year' => 2025,
                'price' => 18500000,
                'badge' => 'В наличии',
                'image' => 'img/catalog-car.png',
                'mileage' => '1 200 км',
                'engine' => '4.0 л (630 л.с.) V8 Biturbo',
                'transmission' => '8-ступенчатый Tiptronic',
                'drive' => 'Полный (quattro)',
                'color' => 'Серый матовый (Nardo Grey)',
                'description' => 'Культовый спортивный универсал с взрывной динамикой. Карбон-керамические тормоза RS, спортивная выхлопная система RS и аудиосистема Bang & Olufsen 3D Advanced.',
                'is_available' => true,
            ],
            [
                'title' => 'Porsche Cayenne Coupe Turbo GT',
                'brand' => 'Porsche',
                'model' => 'Cayenne Coupe',
                'slug' => 'porsche-cayenne-coupe-turbo-gt',
                'year' => 2025,
                'price' => 24900000,
                'badge' => 'Эксклюзив',
                'image' => 'img/catalog-car.png',
                'mileage' => '500 км',
                'engine' => '4.0 л (659 л.с.) V8',
                'transmission' => '8-ступенчатый Tiptronic S',
                'drive' => 'Активный полный привод (PTM)',
                'color' => 'Глубокий черный металлик',
                'description' => 'Флагман спортивных SUV. Разгон 0-100 км/ч за 3.3 секунды. Карбоновая крыша, отделка Alcantara, полноуправляемое шасси и титановый спортивный выхлоп.',
                'is_available' => true,
            ],
            [
                'title' => 'BMW X5 M Competition (F95)',
                'brand' => 'BMW',
                'model' => 'X5 M',
                'slug' => 'bmw-x5-m-competition',
                'year' => 2026,
                'price' => 19800000,
                'badge' => 'Новинка',
                'image' => 'img/catalog-car.png',
                'mileage' => '0 км (Новый)',
                'engine' => '4.4 л (625 л.с.) V8 M TwinPower Turbo',
                'transmission' => '8-ступенчатый M Steptronic',
                'drive' => 'Полный (M xDrive)',
                'color' => 'Синий металлик (Marina Bay Blue)',
                'description' => 'Совершенное воплощение мощи и универсальности. Панорамная крыша Sky Lounge, проекционный дисплей, адаптивные фары и премиальная кожа Merino.',
                'is_available' => true,
            ],
        ];

        foreach ($cars as $car) {
            Car::updateOrCreate(['slug' => $car['slug']], $car);
        }
    }
}
