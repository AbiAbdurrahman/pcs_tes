<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::patch('/carts/add', [App\Http\Controllers\Api\CartController::class, 'addToCart']);
    Route::delete('/cart_items', [App\Http\Controllers\Api\CartItemController::class, 'remove']);
    Route::get('/carts', [App\Http\Controllers\Api\CartController::class, 'show']);
    Route::post('/orders', [App\Http\Controllers\Api\OrderController::class, 'create']);
    Route::get('/orders', [App\Http\Controllers\Api\OrderController::class, 'index']);
    Route::get('/orders/{id}', [App\Http\Controllers\Api\OrderController::class, 'show']);
});

Route::apiResource('/users', App\Http\Controllers\Api\UserController::class);

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
