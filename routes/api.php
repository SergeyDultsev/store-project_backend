<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/check', [AuthController::class, 'check'])->middleware('auth:sanctum');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store'])->middleware('auth:sanctum');
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::put('/product/{id}', [ProductController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/cart', [CartController::class, 'index'])->middleware('auth:sanctum');
Route::post('/cart/{id}', [CartController::class, 'store'])->middleware('auth:sanctum');
Route::put('/cart/{id}', [CartController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->middleware('auth:sanctum');
