<?php

use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// USERS

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// WALLETS

Route::get('/wallets', [WalletController::class, 'index']);
Route::post('/wallets', [WalletController::class, 'store']);
Route::get('/wallets/{id}', [WalletController::class, 'show']);
Route::put('/wallets/{id}', [WalletController::class, 'update']);
Route::delete('/wallets/{id}', [WalletController::class, 'destroy']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
