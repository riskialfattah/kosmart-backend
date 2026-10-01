<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminUserWebController;
use App\Http\Controllers\AdminProductWebController;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/admin/login', [AdminAuthController::class, 'showLogin']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout']);

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/users', [AdminUserWebController::class, 'index']);

Route::get('/admin/users/{user}', [AdminUserWebController::class, 'show']);

Route::get('/admin/products', [AdminProductWebController::class, 'index']);

Route::get('/admin/products/{product}', [AdminProductWebController::class, 'show']);

Route::delete('/admin/products/{product}', [App\Http\Controllers\AdminProductWebController::class, 'destroy']);

Route::get('/admin/categories', [App\Http\Controllers\AdminCategoryWebController::class, 'index']);
Route::get('/admin/categories/create', [App\Http\Controllers\AdminCategoryWebController::class, 'create']);
Route::post('/admin/categories', [App\Http\Controllers\AdminCategoryWebController::class, 'store']);

Route::get('/admin/categories/{category}/edit', [App\Http\Controllers\AdminCategoryWebController::class, 'edit']);
Route::put('/admin/categories/{category}', [App\Http\Controllers\AdminCategoryWebController::class, 'update']);
Route::delete('/admin/categories/{category}', [App\Http\Controllers\AdminCategoryWebController::class, 'destroy']);

Route::get('/admin/wanted-items', [App\Http\Controllers\AdminWantedItemWebController::class, 'index']);
Route::get('/admin/wanted-items/{wantedItem}', [App\Http\Controllers\AdminWantedItemWebController::class, 'show']);
Route::delete('/admin/wanted-items/{wantedItem}', [App\Http\Controllers\AdminWantedItemWebController::class, 'destroy']);

Route::get('/admin/reports', [App\Http\Controllers\AdminReportWebController::class, 'index']);
Route::get('/admin/reports/{report}', [App\Http\Controllers\AdminReportWebController::class, 'show']);
Route::put('/admin/reports/{report}', [App\Http\Controllers\AdminReportWebController::class, 'update']);