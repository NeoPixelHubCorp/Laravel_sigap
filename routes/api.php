<?php
use App\Http\Controllers\Api\AppRatingController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ComplainController;
use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// Route untuk user (untuk yang sudah login, menggunakan Sanctum)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route untuk AuthController (Register, Login, Profile, Logout)
Route::post('register', [AuthController::class, 'register']);  // Register
Route::post('login', [AuthController::class, 'login']);  // Login

// Route untuk yang sudah login
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    //bagian fitur
    Route::apiResource('/complains',ComplainController::class); //aduan CRUD
    Route::put('/profile', [UserController::class, 'update']); //profile U
    Route::get('/profile', [UserController::class, 'profile']); //profile U
    Route::get('/responses/by-complain/{complainId}', [ResponseController::class, 'getResponseByComplain']);// respon admin R
    Route::get('/categories', [CategoryController::class, 'index']);// Categories R
});
