<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\ForceLogout;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Auth;




Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.attempt');
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.attempt');
Route::get('/', [CategoryController::class, 'index'])->name('category.index');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware(ForceLogout::class);

Route::get('/setup-rbac', [RolePermissionController::class, 'setupRolesPermissions'])->name('web.setup.rbac');

Route::resource('categories', CategoryController::class)->names([
    'index' => 'web.categories.index',
    'create' => 'web.categories.create',
    'store' => 'web.categories.store',
    'show' => 'web.categories.show',
    'edit' => 'web.categories.edit',
    'update' => 'web.categories.update',
    'destroy' => 'web.categories.destroy',
]);

Route::resource('categories.posts', PostController::class)->names([
    'index' => 'web.categories.posts.index',
    'create' => 'web.categories.posts.create',
    'store' => 'web.categories.posts.store',
    'show' => 'web.categories.posts.show',
    'edit' => 'web.categories.posts.edit',
    'update' => 'web.categories.posts.update',
    'destroy' => 'web.categories.posts.destroy',
]);

Route::resource('categories.posts.reviews', ReviewController::class)->names([
    'index' => 'web.categories.posts.reviews.index',
    'create' => 'web.categories.posts.reviews.create',
    'store' => 'web.categories.posts.reviews.store',
    'show' => 'web.categories.posts.reviews.show',
    'edit' => 'web.categories.posts.reviews.edit',
    'update' => 'web.categories.posts.reviews.update',
    'destroy' => 'web.categories.posts.reviews.destroy',
]);