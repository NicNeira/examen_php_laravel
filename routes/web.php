<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User CRUD
    // get all users
    Route::get('/users/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    // create user
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    // get user by id
    Route::get('/users/{user}', [UserController::class, 'show'])->name('user.show');
    // update user by id
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    // delete user by id
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Product CRUD
    // get all products
    Route::get('/products/dashboard', [ProductController::class, 'index'])->name('product.dashboard');
    // create product
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    // get product by id
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
    // update product by id
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
    // delete product by id
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    // Client CRUD
    // get all clients
    Route::get('/clients/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    // create client
    Route::post('/clients', [ClientController::class, 'store'])->name('client.store');
    // get client by id
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('client.show');
    // update client by id
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('client.update');
    // delete client by id
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('client.destroy');
});


require __DIR__ . '/auth.php';
