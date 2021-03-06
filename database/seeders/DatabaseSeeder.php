<?php

namespace Database\Seeders;

use App\Models\MaterialTags;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TypesSeeder::class,
            CategorySeeder::class,
            MaterialsSeeder::class,
            TagSeeder::class,
            MaterialTagsSeeder::class,
        ]);
    }
}
