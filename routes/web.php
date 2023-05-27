<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
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

Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

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

Route::prefix('customer')->middleware('auth')->group(function(){
    Route::get('/', [CustomerController::class, 'index'])->name('customer_list');

    Route::get('create', [CustomerController::class, 'create'])->name('customer_create');

    Route::post('store', [CustomerController::class, 'store'])->name('customer_store');

    Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('customer_edit');

    Route::post('update/{id}', [CustomerController::class, 'update'])->name('customer_update');

    Route::get('search', [CustomerController::class, 'search'])->name('customer_search');
});

Route::prefix('cart')->middleware('auth')->group(function(){
    Route::post('store', [CartController::class, 'addToCart'])->name('cart_store');

    Route::get('detail', [CartController::class, 'detail'])->name('cart_detail');

    Route::get('remove/{id}', [CartController::class, 'remove'])->name('cart_remove');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
