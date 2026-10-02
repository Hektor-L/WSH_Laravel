<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',                         [GeneralController::class, 'index'])->name('index');
Route::get('/post-{id}',                [GeneralController::class, 'view'])->name('posts.view');
Route::get('/posts-by-category-{id}',   [GeneralController::class, 'filterByCategory'])->name('posts.by-category');
Route::middleware(['auth', 'verified'])->group(function() {
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
});


Route::middleware('auth')->group(function () {
    Route::get('/profile',          [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',         [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',         [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
