<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    /**
     * @param string $name
     * @return void
     */
    public function createTag(string $name): void
    {
        Tag::create([
           'name' => $name,
        ]);
    }

    /**
     * @param Tag $tag
     * @param string $newName
     * @return void
     */
    public function editTag(Tag $tag, string $newName): void
    {
        $tag->name = $newName;
        $tag->save();
    }

    /**
     * @param Tag $tag
     * @return void
     */
    public function deleteCategory(Tag $tag): void
    {
        $tag->delete();
    }
}
