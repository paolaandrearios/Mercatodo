<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\Order\CartController;
use App\Http\Controllers\Client\Order\CheckoutController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
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
        Route::get('/users', [UserController::class, 'index'])->middleware('can:admin.user.index')->name('user.index');
        Route::get('/categories', [CategoryController::class, 'index'])->middleware('can:admin.category.index')->name('category.index');
        Route::get('/products', [ProductController::class, 'index'])->middleware('can:admin.product.index')->name('product.index');
    });
});


// Client Routes
Route::group(['as'=>'client.'], function () {
    Route::get('/', [ClientProductController::class, 'index'])->name('product.index');
    Route::get('/product/{slug}', [ClientProductController::class, 'show'])->name('product.show');
    Route::get('/order/cart', [CartController::class, 'show'])->name('order.cart');
});

// Client Routes Authenticated

Route::middleware(['auth', 'verified', 'active'])->group(function () {
    Route::get('/order/checkout', [CheckoutController::class, 'show'])->name('order.checkout');
});


Route::get('/locale/{locale?}', function ($locale = null) {
    if (isset($locale) && in_array($locale, config('app.available_locales'))) {
        app()->setLocale($locale);
        \Illuminate\Support\Facades\Session::put('locale', $locale);
    }

    return redirect()->back();
})->name('locale');
