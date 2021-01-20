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
        Route::get('post', [PostController::class, 'index'])->name('posts');
        Route::get('/', [PostController::class, 'create'])->name('post.create');
        Route::post('/', [PostController::class, 'store'])->name('post.store');
        Route::get('/edit/{post:slug}', [PostController::class, 'edit'])->name('post.edit');
        Route::post('/edit/{post:slug}', [PostController::class, 'update'])->name('post.update');
        Route::delete('/{post:slug}', [PostController::class, 'destroy'])->name('post.destroy');

        Route::get('comments', [CommentController::class, 'index'])->name('comments');
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::post('profile', [UserController::class, 'update'])->name('profile.update');

    });