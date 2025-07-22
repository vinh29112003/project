
<?php

use App\Http\Controllers\API\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ReviewController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('categories.posts', PostController::class)->only(['index', 'show']);
Route::apiResource('categories.posts.reviews', ReviewController::class)->only(['index', 'show']);

// ✅ Chỉ ADMIN mới được quản lý categories, posts, reviews
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
    Route::apiResource('categories.posts', PostController::class)->except(['index', 'show']);
    Route::apiResource('categories.posts.reviews', ReviewController::class)->except(['index', 'show', 'store']);
});

// ✅ Người dùng (user) đăng nhập mới được viết review
Route::middleware(['auth:sanctum', 'role:user|admin'])->group(function () {
    Route::post('categories/{category}/posts/{post}/reviews', [ReviewController::class, 'store']);
});

