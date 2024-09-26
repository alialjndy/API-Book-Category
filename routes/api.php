<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('register', [AuthController::class , 'register']);
Route::post('login', [AuthController::class , 'login']);
Route::get('me', [AuthController::class , 'me']);
Route::post('logout', [AuthController::class , 'logout']);

Route::apiResource('Book',BookController::class);
Route::apiResource('categories',CategoryController::class);
Route::get('categories/{categoryId}/books', [BookController::class,'indexByCategoryID']);


