<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',                         [GeneralController::class, 'index'])->name('index');
Route::get('/post-{id}',                [GeneralController::class, 'view'])->name('posts.view');
Route::get('/posts-by-category-{id}',   [GeneralController::class, 'filterByCategory'])->name('posts.by-category');
Route::middleware(['auth'])->group(function() {
    Route::get('/create-post',   [GeneralController::class, 'create'])->name('posts.create');
    Route::post('/',             [GeneralController::class, 'store'])->name('posts.store');

    Route::get('/dashboard', function() { return view('dashboard');})->name('dashboard');
    Route::get('/dashboard/posts',              [PostController::class, 'index'])->name('dashboard.posts.index');
    Route::get('/dashboard/posts/create',       [PostController::class, 'create'])->name('dashboard.posts.create');
    Route::post('/dashboard/posts',             [PostController::class, 'store'])->name('dashboard.posts.store');
    Route::get('/dashboard/posts/{id}',         [PostController::class, 'edit'])->name('dashboard.posts.edit');
    Route::patch('/dashboard/posts/{id}',       [PostController::class, 'update'])->name('dashboard.posts.update');
    Route::delete('/dashboard/posts/{id}',      [PostController::class, 'destroy'])->name('dashboard.posts.delete');
    Route::put('/dashboard/posts',              [PostController::class, 'search'])->name('dashboard.posts.search');

    Route::get('/dashboard/comments',           [CommentController::class, 'index'])->name('dashboard.comments.index');
    Route::get('/dashboard/comments/create',    [CommentController::class, 'create'])->name('dashboard.comments.create');
    Route::post('/dashboard/comments',          [CommentController::class, 'store'])->name('dashboard.comments.store');
    Route::get('/dashboard/comments/{id}',      [CommentController::class, 'edit'])->name('dashboard.comments.edit');
    Route::patch('/dashboard/comments/{id}',    [CommentController::class, 'update'])->name('dashboard.comments.update');
    Route::delete('/dashboard/comments/{id}',   [CommentController::class, 'destroy'])->name('dashboard.comments.delete');
    Route::put('/dashboard/comments',           [CommentController::class, 'search'])->name('dashboard.comments.search');

    Route::get('/dashboard/categories',         [CategoryController::class, 'index'])->name('dashboard.categories.index');
    Route::get('/dashboard/categories/create',  [CategoryController::class, 'create'])->name('dashboard.categories.create');
    Route::post('/dashboard/categories',        [CategoryController::class, 'store'])->name('dashboard.categories.store');
    Route::get('/dashboard/categories/{id}',   [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
    Route::patch('/dashboard/categories/{id}',  [CategoryController::class, 'update'])->name('dashboard.categories.update');
    Route::delete('/dashboard/categories/{id}', [CategoryController::class, 'destroy'])->name('dashboard.categories.delete');
    Route::put('/dashboard/categories',        [CategoryController::class, 'search'])->name('dashboard.categories.search');

    Route::get('/dashboard/users',         [UserController::class, 'index'])->name('dashboard.users.index');
    Route::get('/dashboard/users/create',  [UserController::class, 'create'])->name('dashboard.users.create');
    Route::post('/dashboard/users',        [UserController::class, 'store'])->name('dashboard.users.store');
    Route::get('/dashboard/users/{id}',   [UserController::class, 'edit'])->name('dashboard.users.edit');
    Route::patch('/dashboard/users/{id}',  [UserController::class, 'update'])->name('dashboard.users.update');
    Route::delete('/dashboard/users/{id}', [UserController::class, 'destroy'])->name('dashboard.users.delete');
    Route::put('/dashboard/users',        [UserController::class, 'search'])->name('dashboard.users.search');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile',          [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',         [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',         [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
