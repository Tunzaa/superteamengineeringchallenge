<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

// Authentication Routes
Auth::routes();  // This will automatically register the login, logout, registration, and password reset routes
// Home route 
Route::get('/', function () {
    return view('welcome');  // Displays the welcome page
});

// Dashboard (requires authentication)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Sales Routes
Route::prefix('sales')->middleware('auth')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('sales.index');  // List sales
    Route::get('/create', [SaleController::class, 'create'])->name('sales.create');  // Create new sale
    Route::post('/', [SaleController::class, 'store'])->name('sales.store');  // Store new sale
    Route::get('/{id}/edit', [SaleController::class, 'edit'])->name('sales.edit');  // Edit sale
    Route::put('/{id}', [SaleController::class, 'update'])->name('sales.update');  // Update sale
    Route::delete('/{id}', [SaleController::class, 'destroy'])->name('sales.destroy');  // Delete sale
    Route::get('/export', [SaleController::class, 'export'])->name('sales.export');  // Export sales to CSV
});

// Product Routes (for creating and managing products)
Route::prefix('products')->middleware('auth')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');  // List products
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');  // Create new product
    Route::post('/', [ProductController::class, 'store'])->name('products.store');  // Store new product
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');  // Edit product
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');  // Update product
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');  // Delete product
    Route::get('/inventory/export', [ProductController::class, 'export'])->name('products.export');
});

// Access Log route (optional, can be used to view logs for auditing or admin purposes)
Route::get('/access-logs', function () {
    // This route would normally return logs from the database or file (depending on your setup)
    return view('access_logs.index');
})->middleware('auth');  // Make sure this route is protected with authentication
// Logout Route (Laravel's Auth system automatically handles this)
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Redirect user to dashboard after successful login
Route::get('/home', function () {
    return redirect()->route('dashboard');
});