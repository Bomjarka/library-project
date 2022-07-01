<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Деловые/Бизнес-процессы',
            'Деловые/Найм',
            'Деловые/Реклама',
            'Деловые/Управление бизнесом',
            'Деловые/Управление людьми',
            'Деловые/Управление проектами',
            'Детские/Воспитание',
            'Дизайн/Общее',
            'Дизайн/Logo',
            'Дизайн/Web дизайн',
            'Разработка/PHP',
            'Разработка/HTML и CSS',
            'Разработка/Проектирование'
        ];

        foreach ($categories as $categoryName) {
            Category::factory()->create(['name' => $categoryName]);
        }

    }
}
