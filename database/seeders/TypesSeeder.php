<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'книга',
            'статья',
            'видео',
            'сайт/блог',
            'подборка',
            'ключевые идеи книги',
        ];

        foreach ($types as $typeName) {
            Type::factory()->create(['name' => $typeName]);
        }
    }
}
