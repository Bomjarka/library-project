<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function createCategory(string $name)
    {
        Category::create([
            'name' => $name,
        ]);
    }

    public function editCategory(Category $category, string $newName)
    {
        $category->name = $newName;
        $category->save();
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
    }
}
