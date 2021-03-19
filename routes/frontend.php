<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ResourceController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;


// Authentication
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Sitemap
Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Profile
Route::get('profile', [UserController::class, 'profile'])->name('front.profile');

// Search
Route::get('search', [SearchController::class, 'search'])->name('front.search');

// Saving comment
Route::post('comment/{post:id}', [CommentController::class, 'store'])->name('comment.store');
Route::post('comment/admin/{post:id}', [CommentController::class, 'storeForAdmin'])->name('comment.store_for_admin');

// Posts in frontend
Route::get('/', [PostController::class, 'index'])->name('front.posts');
Route::get('tag/{tag:slug}', [PostController::class, 'fetchByTag'])->name('front.posts.fetch');

// Post and page in frontend
Route::get('{slug}', [ResourceController::class, 'show'])->name('front.resource.show');
