<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\ProductController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

// Admin Routes
Route::group(['prefix' => 'admin', 'as'=>'admin.'], function () {
    Route::middleware(['auth', 'verified', 'active'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/users', [UserController::class, 'index'])->middleware('can:user.index')->name('user.index');
        Route::get('/categories', [CategoryController::class, 'index'])->middleware('can:category.index')->name('category.index');
    });
});

Route::group(['as'=>'client.'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
});


