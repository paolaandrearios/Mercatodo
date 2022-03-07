<?php

use App\Http\Controllers\Api\Admin\CategoryController as CategoryAdminController;
use App\Http\Controllers\Api\Admin\CategoryStatusController;
use App\Http\Controllers\Api\Admin\ProductController as ProductAdminController;
use App\Http\Controllers\Api\Admin\ProductStatusController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\UserStatusController;
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

//Protected routes

Route::group(['middleware' => 'auth:sanctum' ,'prefix' => 'admin', 'as'=>'admin.'], function () {

    Route::resource('users', UserController::class)->only([
        'index', 'update',
    ]);
    Route::put('/users/{user}/status/{status}', [UserStatusController::class, 'update'])->name('users.status');


    Route::put('/categories/{category}/status/{status}', [CategoryStatusController::class, 'update'])->name('categories.status');
    Route::resource('categories', CategoryAdminController::class)->only([
        'store', 'show', 'index', 'update',
    ]);

    Route::put('/products/{product}/status/{status}', [ProductStatusController::class, 'update'])->name('product.status');

    Route::resource('products', ProductAdminController::class)->only([
        'store', 'show', 'index', 'update',
    ]);
});

//Public Routes
Route::resource('products', ProductController::class)->only([
     'index',
]);

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::resource('categories', CategoryController::class)->only([
    'show', 'index',
]);
