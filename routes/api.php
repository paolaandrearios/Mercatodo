<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductStatusController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CategoryStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('users', UserController::class)->only([
    'index', 'update', 'updateStatus',
]);
Route::put('/users/{user}/status/{status}', [UserController::class, 'updateStatus'])->name('users.status');


//categories routes
Route::put('/categories/{category}/status/{status}', [CategoryStatusController::class, 'update'])->name('categories.status');
Route::resource('categories', CategoryController::class)->only([
    'store', 'show', 'index', 'update',
]);


//Product routes
Route::put('/products/{product}/status/{status}', [ProductStatusController::class, 'update'])->name('product.status');
Route::resource('products', ProductController::class)->only([
    'store', 'show', 'index', 'update',
]);
