<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ClientController;

// Ruta de prueba
Route::get('/', function () {
    return response()->json(['message' => '¡Hola, mundo!']);
});

// Rutas públicas
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    // Usuarios
    Route::apiResource('users', UserController::class);

    // Productos
    Route::apiResource('products', ProductController::class);

    // Clientes
    Route::apiResource('clients', ClientController::class);

    // Cerrar sesión
    Route::post('/logout', [UserController::class, 'logout']);
});
