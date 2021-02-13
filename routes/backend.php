<?php

use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\EditorImageUploadController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\TagController;


// Posts
Route::get('posts', [PostController::class, 'index'])->name('posts');
Route::get('posts/tag/{tag:slug}', [PostController::class, 'fetchByTag'])->name('posts.fetch');
Route::get('/', [PostController::class, 'create'])->name('posts.create');
Route::post('/', [PostController::class, 'store'])->name('posts.store');
Route::get('posts/{post:slug}', [PostController::class, 'edit'])->name('posts.edit');
Route::post('posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
Route::delete('posts/destroy/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');

// Pages
Route::get('/pages/', [PageController::class, 'index'])->name('pages');
Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
Route::post('/pages/create', [PageController::class, 'store'])->name('pages.store');
Route::get('pages/{page:slug}', [PageController::class, 'edit'])->name('pages.edit');
Route::post('pages/{page:slug}', [PageController::class, 'store'])->name('pages.update');
Route::delete('pages/destroy/{page:slug}', [PageController::class, 'destroy'])->name('pages.destroy');

// Tags
Route::get('tags', [TagController::class, 'index'])->name('tags');

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