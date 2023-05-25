<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('dashboard', function () {
    return view('welcome');
})->middleware('auth');

Route::prefix('category')->middleware('auth')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('category_list');

    Route::post('store', [CategoryController::class, 'store'])->name('category_store');

    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category_edit');

    Route::post('update/{id}', [CategoryController::class, 'update'])->name('category_update');

    Route::get('remove/{id}', [CategoryController::class, 'remove'])->name('category_remove');
});

Route::prefix('product')->middleware('auth')->group(function(){
    Route::get('/', [ProductController::class, 'index'])->name('product_list');

    Route::get('create', [ProductController::class, 'create'])->name('product_create');

    Route::post('store', [ProductController::class, 'store'])->name('product_store');

    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product_edit');

    Route::post('update/{id}', [ProductController::class, 'update'])->name('product_update');

    Route::get('remove/{id}', [ProductController::class, 'remove'])->name('product_remove');

    Route::get('import', [ProductController::class, 'import'])->name('product_import');

    Route::post('import-code', [ProductController::class, 'importCode'])->name('product_import_code');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
