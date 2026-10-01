<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\WantedItemController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\AdminCategoryController;
use App\Http\Controllers\Api\AdminProductController;
use App\Http\Controllers\Api\AdminWantedItemController;
use App\Http\Controllers\Api\ProductImageController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [AuthController::class, 'update']);

    Route::get('/admin/users', [AdminUserController::class, 'index']);
    Route::get('/admin/users/{user}', [AdminUserController::class, 'show']);
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update']);
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy']);

    Route::get('/admin/categories', [AdminCategoryController::class, 'index']);
    Route::get('/admin/categories/{category}', [AdminCategoryController::class, 'show']);
    Route::post('/admin/categories', [AdminCategoryController::class, 'store']);
    Route::put('/admin/categories/{category}', [AdminCategoryController::class, 'update']);
    Route::delete('/admin/categories/{category}', [AdminCategoryController::class, 'destroy']);

    Route::get('/admin/products', [AdminProductController::class, 'index']);
    Route::get('/admin/products/{product}', [AdminProductController::class, 'show']);
    Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy']);

    Route::get('/admin/wanted-items', [AdminWantedItemController::class, 'index']);
    Route::get('/admin/wanted-items/{wantedItem}', [AdminWantedItemController::class, 'show']);
    Route::patch('/admin/wanted-items/{wantedItem}/status', [AdminWantedItemController::class, 'updateStatus']);
    Route::delete('/admin/wanted-items/{wantedItem}', [AdminWantedItemController::class, 'destroy']);

    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/my-products', [ProductController::class, 'myProducts']);

    Route::post('/products/{product}/images', [ProductImageController::class, 'store']);
    Route::delete('/product-images/{productImage}', [ProductImageController::class, 'destroy']);

    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    Route::patch('/products/{product}/sold', [ProductController::class, 'markAsSold']);

    Route::post('/products/{product}/favorite', [FavoriteController::class, 'store']);
    Route::delete('/products/{product}/favorite', [FavoriteController::class, 'destroy']);
    Route::get('/favorites', [FavoriteController::class, 'index']);

    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/messages', [MessageController::class, 'index']);

    Route::get('/wanted-items', [WantedItemController::class, 'index']);
    Route::post('/wanted-items', [WantedItemController::class, 'store']);
    Route::get('/wanted-items/{wantedItem}', [WantedItemController::class, 'show']);
    Route::put('/wanted-items/{wantedItem}', [WantedItemController::class, 'update']);
    Route::delete('/wanted-items/{wantedItem}', [WantedItemController::class, 'destroy']);

    Route::post('/products/{product}/ratings', [RatingController::class, 'store']);
    Route::get('/products/{product}/ratings', [RatingController::class, 'index']);

    Route::post('/products/{product}/reports', [ReportController::class, 'store']);
    Route::get('/reports', [ReportController::class, 'index']);
    Route::patch('/reports/{report}/status', [ReportController::class, 'updateStatus']);
    
});