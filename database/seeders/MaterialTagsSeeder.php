<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\MaterialTags;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class MaterialTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = Material::all();
        foreach ($materials as $material) {
            $tag = Tag::all()->random();

            $materialTagExists = MaterialTags::whereMaterialId($material->id)
                ->whereTagId($tag->id)
                ->get();
            if (!$materialTagExists->isEmpty()) {
                continue;
            }

            MaterialTags::factory([
                'material_id' => $material->id,
                'tag_id' => $tag->id,
            ])->create();
        }
    }
}
