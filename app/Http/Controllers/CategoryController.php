<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\TagService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function viewCategories()
    {
        $categories = Category::all();

        return view('pages.categories.categories', ['categories' => $categories]);
    }

    public function viewCategory(Category $category)
    {
        return view('pages.categories.view-category', ['category' => $category]);
    }

    public function newCategory()
    {
        return view('pages.categories.create-category');
    }

    public function addCategory(Request $request, CategoryService $categoryService)
    {
        $categoryName = $request->get('category-name');

        if ($categoryName && !Category::whereName($categoryName)->first()) {
            $categoryService->createCategory($categoryName);

            return redirect(route('viewCategories'));
        }

        return redirect(route('viewCategories'))->withErrors(['message' => 'Such category already exists']);
    }

    public function editCategory(Category $category, Request $request, CategoryService $categoryService)
    {
        $categoryName = $request->get('category-name');

        if ($categoryName && !Category::whereName($categoryName)->first()) {
            $categoryService->editCategory($category, $categoryName);

            return redirect(route('viewCategories'));
        }

        return redirect(route('viewCategories'))->withErrors(['message' => 'Such category already exists']);
    }

    public function deleteCategory(Category $category, Request $request, CategoryService $categoryService)
    {
        if ($category) {
            $categoryService->deleteCategory($category);
        }

        return redirect(route('viewCategories'));
    }
}
