<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('main');

Route::prefix('materials')->group(function () {
    Route::get('/', [MaterialController::class, 'viewMaterials'])->name('viewMaterials');
    Route::get('/create', function () {
        return view('pages.materials.create-material');
    })->name('tags');
    Route::post('/create', [MaterialController::class, 'createMaterial'])->name('createMaterial');
    Route::post('/find', [MaterialController::class, 'findMaterials'])->name('findMaterials');
    Route::prefix('{material}')->group(function () {
        Route::get('/', [MaterialController::class, 'viewMaterial'])->name('viewMaterial');
        Route::post('/edit', [MaterialController::class, 'editMaterial'])->name('editMaterial');
        Route::post('/add-link', [MaterialController::class, 'addLink'])->name('addLink');
        Route::post('/delete-link', [MaterialController::class, 'deleteLink'])->name('deleteLink');
        Route::post('/delete', [MaterialController::class, 'deleteMaterial'])->name('deleteMaterial');
    });
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'viewCategories'])->name('viewCategories');
    Route::prefix('new-category')->group(function () {
        Route::get('/', [CategoryController::class, 'newCategory'])->name('newCategory');
        Route::post('/add', [CategoryController::class, 'addCategory'])->name('addCategory');
    });
    Route::prefix('{category}')->group(function () {
        Route::get('/', [CategoryController::class, 'viewCategory'])->name('viewCategory');
        Route::post('/edit', [CategoryController::class, 'editCategory'])->name('editCategory');
        Route::post('/delete', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
    });
});

Route::prefix('tags')->group(function () {
    Route::get('/', [TagsController::class, 'viewTags'])->name('viewTags');
    Route::get('/create', [TagsController::class, 'createTag'])->name('createTag');
});

Route::prefix('types')->group(function () {
    Route::get('/', [TypeController::class, 'viewTypes'])->name('viewTypes');
    Route::get('/create', [TypeController::class, 'createType'])->name('createType');
});
