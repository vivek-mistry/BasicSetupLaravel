<?php

use App\Http\Controllers\CategoryController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
