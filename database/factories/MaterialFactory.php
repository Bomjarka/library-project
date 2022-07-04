<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'type_id' => Arr::random(Type::all()->pluck('id')->toArray()),
            'category_id' => Arr::random(Category::all()->pluck('id')->toArray()),
            'author' => $this->faker->name(Arr::random(['f', 'm'])),
            'description' => $this->faker->text(100),
            'data' => $this->makeJson(),
        ];
    }

    private function makeJson()
    {
        $i = 0;
        $data = [];
        while ($i < 10) {
            $link['link-description'] = $this->faker->text(10);
            $link['link-url'] = $this->faker->url();
            $link['link-uuid'] = $this->faker->uuid();

            $data['links'][] = $link;
            $i++;
        }

        return json_encode($data, 1);
    }
}
