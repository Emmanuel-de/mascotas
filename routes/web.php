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

     // Product routes
    Route::resource('products', App\Http\Controllers\ProductController::class);

     // Pet routes  
    Route::resource('pets', App\Http\Controllers\PetController::class);

    // Sale routes  
    Route::resource('sales', App\Http\Controllers\SaleController::class);

    // customer routes  
    Route::resource('customers', App\Http\Controllers\CustomerController::class);
});


require __DIR__.'/auth.php';
