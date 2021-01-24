<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\UserController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::group([
    'prefix' => '/home',
    'middleware' => ['auth']],
    function() {

        // Posts
        Route::get('posts', [PostController::class, 'index'])->name('posts');
        Route::get('posts/tag/{tag:slug}', [PostController::class, 'fetch'])->name('posts.fetch');
        Route::get('/', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post:slug}', [PostController::class, 'edit'])->name('posts.edit');
        Route::post('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');

        //Comments
        Route::get('comments', [CommentController::class, 'index'])->name('comments');
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

        //Profile
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::post('profile', [UserController::class, 'update'])->name('profile.update');

    });