<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    /**
     * @param $name
     * @return void
     */
    public function createTag($name): void
    {
        Tag::create([
           'name' => $name,
        ]);
    }
}
