<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use App\Services\TagService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CategoryController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function viewCategories()
    {
        $categories = Category::all();

        return view('pages.categories.categories', ['categories' => $categories]);
    }

    /**
     * @param Category $category
     * @return Application|Factory|View
     */
    public function viewCategory(Category $category)
    {
        return view('pages.categories.view-category', ['category' => $category]);
    }

    /**
     * @return Application|Factory|View
     */
    public function newCategory()
    {
        return view('pages.categories.create-category');
    }

    /**
     * @param Request $request
     * @param CategoryService $categoryService
     * @return Application|RedirectResponse|Redirector
     */
    public function addCategory(Request $request, CategoryService $categoryService)
    {
        $categoryName = $request->get('category-name');

        if ($categoryName && !Category::whereName($categoryName)->first()) {
            $categoryService->createCategory($categoryName);

            return redirect(route('viewCategories'));
        }

        return redirect(route('viewCategories'))->withErrors(['message' => 'Such category already exists']);
    }

    /**
     * @param Category $category
     * @param Request $request
     * @param CategoryService $categoryService
     * @return Application|RedirectResponse|Redirector
     */
    public function editCategory(Category $category, Request $request, CategoryService $categoryService)
    {
        $categoryName = $request->get('category-name');

        if ($categoryName && !Category::whereName($categoryName)->first()) {
            $categoryService->editCategory($category, $categoryName);

            return redirect(route('viewCategories'));
        }

        return redirect(route('viewCategories'))->withErrors(['message' => 'Such category already exists']);
    }

    /**
     * @param Category $category
     * @param CategoryService $categoryService
     * @return JsonResponse
     */
    public function deleteCategory(Category $category, CategoryService $categoryService): JsonResponse
    {
        $categoryService->deleteCategory($category);

        return response()->json([
            'msg' => 'success',
        ]);
    }
}
