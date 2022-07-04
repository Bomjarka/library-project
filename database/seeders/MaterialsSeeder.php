<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Type;
use Illuminate\Database\Seeder;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Material::factory()->count(10)->create();
    }
}
