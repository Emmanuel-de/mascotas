<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product routes with role-based access
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])
        ->middleware('role:administrator,employee,customer')->name('products.index');
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])
        ->middleware('role:administrator,employee')->name('products.create');
    Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])
        ->middleware('role:administrator,employee')->name('products.store');
    Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])
        ->middleware('role:administrator,employee,customer')->name('products.show');
    Route::get('/products/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])
        ->middleware('role:administrator,employee')->name('products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])
        ->middleware('role:administrator,employee')->name('products.update');
    Route::patch('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])
        ->middleware('role:administrator,employee')->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])
        ->middleware('role:administrator')->name('products.destroy');

    // Sales routes with role-based access
    Route::get('/sales', [App\Http\Controllers\SaleController::class, 'index'])
        ->middleware('role:administrator,employee,customer')->name('sales.index');
    Route::get('/sales/create', [App\Http\Controllers\SaleController::class, 'create'])
        ->middleware('role:administrator,employee')->name('sales.create');
    Route::post('/sales', [App\Http\Controllers\SaleController::class, 'store'])
        ->middleware('role:administrator,employee')->name('sales.store');
    Route::get('/sales/{sale}', [App\Http\Controllers\SaleController::class, 'show'])
        ->middleware('role:administrator,employee,customer')->name('sales.show');
    Route::get('/sales/{sale}/edit', [App\Http\Controllers\SaleController::class, 'edit'])
        ->middleware('role:administrator,employee')->name('sales.edit');
    Route::put('/sales/{sale}', [App\Http\Controllers\SaleController::class, 'update'])
        ->middleware('role:administrator,employee')->name('sales.update');
    Route::patch('/sales/{sale}', [App\Http\Controllers\SaleController::class, 'update'])
        ->middleware('role:administrator,employee')->name('sales.update');
    Route::delete('/sales/{sale}', [App\Http\Controllers\SaleController::class, 'destroy'])
        ->middleware('role:administrator,employee')->name('sales.destroy');

    // Pet routes - admin and employees only
    Route::resource('pets', App\Http\Controllers\PetController::class)
        ->middleware('role:administrator,employee');

    // Customer routes - admin and employees only
    Route::resource('customers', App\Http\Controllers\CustomerController::class)
        ->middleware('role:administrator,employee');
});


require __DIR__.'/auth.php';
