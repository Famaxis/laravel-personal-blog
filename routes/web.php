<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\EditorImageUploadController;
use App\Http\Controllers\Frontend\PostController as FrontPost;
use App\Http\Controllers\SitemapController;


// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Sitemap
Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Backend
Route::group([
    'prefix' => '/home',
    'middleware' => ['auth']],
    function() {
        // Posts
        Route::get('posts', [PostController::class, 'index'])->name('posts');
        Route::get('posts/tag/{tag:slug}', [PostController::class, 'fetchByTag'])->name('posts.fetch');
        Route::get('/', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::post('/image', [EditorImageUploadController::class, 'uploadImage'])->name('upload_image');
        Route::get('/posts/{post:slug}', [PostController::class, 'edit'])->name('posts.edit');
        Route::post('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/destroy/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');

        // Comments
        Route::get('comments', [CommentController::class, 'index'])->name('comments');
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

        // Profile
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::post('profile', [UserController::class, 'update'])->name('profile.update');

        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    });

// Posts in frontend
Route::get('/', [FrontPost::class, 'index'])->name('front.posts');
Route::get('/tag/{tag:slug}', [FrontPost::class, 'fetchByTag'])->name('front.posts.fetch');
Route::get('/{post:slug}', [FrontPost::class, 'show'])->name('front.posts.show');