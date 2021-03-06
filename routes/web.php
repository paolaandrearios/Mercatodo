<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\Order\CartController;
use App\Http\Controllers\Client\Order\CheckoutController;
use App\Http\Controllers\Client\Order\OrderHistoryController;
use App\Http\Controllers\Client\Order\OrderThanksController;
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
        Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('can:admin.dashboard.index')->name('dashboard.index');
        Route::get('/users', [UserController::class, 'index'])->middleware('can:admin.user.index')->name('user.index');
        Route::get('/categories', [CategoryController::class, 'index'])->middleware('can:admin.category.index')->name('category.index');
        Route::get('/products', [ProductController::class, 'index'])->middleware('can:admin.product.index')->name('product.index');
        Route::get('/import/products', [ImportController::class, 'show'])->middleware('can:admin.products.import')->name('products.import');
        Route::get('/export/products', [ExportController::class, 'show'])->middleware('can:admin.products.export')->name('products.export');
        Route::get('/reports', [ReportController::class, 'show'])->middleware('can:admin.reports')->name('reports');
        Route::get('/orders/index', [OrderController::class, 'show'])->middleware('can:admin.orders.index')->name('orders.index');
    });
});

// Client Routes
Route::group(['as'=>'client.'], function () {
    Route::middleware(['active'])->group(function () {
        Route::get('/', [ClientProductController::class, 'index'])->name('product.index');
        Route::get('/product/{slug}', [ClientProductController::class, 'show'])
            ->name('product.show')
            ->middleware('product.visit');
        Route::get('/order/cart', [CartController::class, 'show'])->name('order.cart');
        Route::get('/order/thanks/{order}', [OrderThanksController::class, 'show'])->name('order.thanks');
    });
});

// Client Routes Authenticated

Route::middleware(['auth', 'verified', 'active'])->group(function () {
    Route::get('/order/checkout', [CheckoutController::class, 'show'])->name('order.checkout');
    Route::get('/orders/history', [OrderHistoryController::class, 'show'])->name('orders.history');
});

Route::get('/locale/{locale?}', function ($locale = null) {
    if (isset($locale) && in_array($locale, config('app.available_locales'))) {
        app()->setLocale($locale);
        \Illuminate\Support\Facades\Session::put('locale', $locale);
    }

    return redirect()->back();
})->name('locale');
