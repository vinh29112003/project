<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\ForceLogout;



Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.attempt');
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.attempt');
Route::get('/', [CategoryController::class, 'index'])->name('category.index');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware(ForceLogout::class);


Route::resource('categories', CategoryController::class);
Route::resource('categories.posts', PostController::class);
Route::resource('categories.posts.reviews', ReviewController::class);


