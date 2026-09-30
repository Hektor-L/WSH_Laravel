<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/user', function (Request $request) {return $request->user();});
    Route::get('/users', [UserController::class,'returnUsers']);
    Route::get('/posts', [PostController::class, 'returnPosts']);
    Route::get('/comments', [CommentController::class,'returnComments']);
    Route::get('/categories', [CategoryController::class,'returnCategories']);
});
