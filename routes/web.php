<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\EditorImageUploadController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\CommentController as FrontComment;
use App\Http\Controllers\Frontend\PostController as FrontPost;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;


// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Sitemap
Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Backend
Route::group([
    'prefix'     => '/home',
    'middleware' => ['auth']],
    function () {
        // Posts
        Route::get('posts', [PostController::class, 'index'])->name('posts');
        Route::get('posts/tag/{tag:slug}', [PostController::class, 'fetchByTag'])->name('posts.fetch');
        Route::get('/', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('posts/{post:slug}', [PostController::class, 'edit'])->name('posts.edit');
        Route::post('posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('posts/destroy/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');

        // Image
        Route::post('image', [EditorImageUploadController::class, 'uploadImage'])->name('upload_image');

        // Comments
        Route::get('comments', [CommentController::class, 'index'])->name('comments');
        Route::get('comments/{comment}', [CommentController::class, 'edit'])->name('comments.edit');
        Route::post('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
        Route::delete('comments/delete/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

        // Profile
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::post('profile', [UserController::class, 'update'])->name('profile.update');
        Route::post('profile/password', [UserController::class, 'changePassword'])->name('profile.password_change');

        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    });

// Saving comment
Route::post('comment/{post:slug}', [FrontComment::class, 'store'])->name('comment.store');
Route::post('comment/admin/{post:slug}', [FrontComment::class, 'storeForAdmin'])->name('comment.store_for_admin');

// Posts in frontend
Route::get('/', [FrontPost::class, 'index'])->name('front.posts');
Route::get('tag/{tag:slug}', [FrontPost::class, 'fetchByTag'])->name('front.posts.fetch');
Route::get('{post:slug}', [FrontPost::class, 'show'])->name('front.posts.show');

