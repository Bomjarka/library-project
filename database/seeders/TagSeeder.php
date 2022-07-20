<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Продуктивность',
            'Личная эффективность',
            'Праздники',
            'Город',
            'Образование',
            'Саморазвитие',
        ];

        foreach ($categories as $categoryName) {
            Tag::factory()->create(['name' => $categoryName]);
        }

    }
}
