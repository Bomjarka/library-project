<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function createTag($name)
    {
        Tag::create([
           'name' => $name,
        ]);
    }
}
