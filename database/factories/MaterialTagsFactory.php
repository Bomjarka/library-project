<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialTagsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag_id' => Tag::inRandomOrder()->first()->id,
            'material_id' => Material::inRandomOrder()->first()->id
        ];
    }
}
