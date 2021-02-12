<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;


// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Sitemap
Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Saving comment
Route::post('comment/{post:slug}', [CommentController::class, 'store'])->name('comment.store');
Route::post('comment/admin/{post:slug}', [CommentController::class, 'storeForAdmin'])->name('comment.store_for_admin');

// Posts in frontend
Route::get('/', [PostController::class, 'index'])->name('front.posts');
Route::get('tag/{tag:slug}', [PostController::class, 'fetchByTag'])->name('front.posts.fetch');
Route::get('{post:slug}', [PostController::class, 'show'])->name('front.posts.show');

