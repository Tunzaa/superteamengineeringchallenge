<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\salesController;
use App\Http\Controllers\homeController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [homeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::resource('products', ProductController::class)->middleware(['auth', 'verified']);

// Route::get('/product/create', [ProductController::class, 'create'])
// ->middleware(['auth', 'verified'])
// ->name('products.create');

// Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show')->middleware(['auth', 'verified']);
// Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware(['auth', 'verified']);
// Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware(['auth', 'verified']);
// Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update')->middleware(['auth', 'verified']);
// Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware(['auth', 'verified']);


Route::resource('categories', CategoryController::class)->middleware(['auth', 'verified']);
Route::resource('sales', salesController::class)->middleware(['auth', 'verified']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
