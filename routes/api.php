<?php

use App\Http\Controllers\Api\AppRatingController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ComplainController;
use App\Http\Controllers\Api\ComplainRatingController;
use App\Http\Controllers\Api\ResponseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route untuk user (untuk yang sudah login, menggunakan Sanctum)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route untuk AuthController (Register, Login, Profile, Logout)
Route::post('register', [AuthController::class, 'register']);  // Register
Route::post('login', [AuthController::class, 'login']);  // Login

// Route yang memerlukan autentikasi (untuk yang sudah login)
Route::middleware('auth:sanctum')->group(function () {
    // Route untuk Profile dan Logout
    Route::get('profile', [AuthController::class, 'profile']);  // Mendapatkan profil user
    Route::post('logout', [AuthController::class, 'logout']);  // Logout user

    // Route untuk resource AppRating
    Route::apiResource('app-ratings', AppRatingController::class);  // CRUD AppRating
    // Route untuk resource Category
    Route::apiResource('categories', CategoryController::class);  // CRUD Category
    // Route untuk resource Complain
    Route::apiResource('complains', ComplainController::class);  // CRUD Complain
    // Route untuk resource ComplainRating
    Route::apiResource('complain-ratings', ComplainRatingController::class);  // CRUD ComplainRating
    // Route untuk resource Response
    Route::apiResource('responses', ResponseController::class);  // CRUD Response
});
