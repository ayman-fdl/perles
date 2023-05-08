<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Admin Routes
    Route::group(['middleware' => 'is.admin'], function () {
        Route::post('AdminRole/{id}', [AdminController::class, 'AdminRole']);
        Route::post('UserRole/{id}', [AdminController::class, 'UserRole']);

        // Product with Admin Role
        Route::post('/product/store', [ProductController::class, 'store']);
        Route::post('/product/{id}/update', [ProductController::class, 'update']);
        Route::post('/product/{id}/delete', [ProductController::class, 'destroy']);

        // Client with Admin Role
        Route::post('/client/store', [ClientController::class, 'store']);
        Route::post('/client/{id}/update', [ClientController::class, 'update']);
        Route::post('/client/{id}/delete', [ClientController::class, 'destroy']);
    });

    // User Routes
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/user/logout', [AuthController::class, 'logout']);
    Route::post('/user/update', [AuthController::class, 'update']);

    // Product
    Route::get('/product/showAll', [ProductController::class, 'index']);
    Route::get('/product/show/{id}', [ProductController::class, 'show']);

    // Client
    Route::get('/client/showAll', [ClientController::class, 'index']);
    Route::get('/client/show/{id}', [ClientController::class, 'show']);

});


// Public User Route
Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);

Route::get('/allUser', [AuthController::class, 'alluser']);
Route::get('/finduser/{id}', [AuthController::class, 'finduser']);




