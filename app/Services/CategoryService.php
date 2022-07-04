<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * @param string $name
     * @return void
     */
    public function createCategory(string $name): void
    {
        Category::create([
            'name' => $name,
        ]);
    }

    /**
     * @param Category $category
     * @param string $newName
     * @return void
     */
    public function editCategory(Category $category, string $newName): void
    {
        $category->name = $newName;
        $category->save();
    }

    /**
     * @param Category $category
     * @return void
     */
    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }
}
