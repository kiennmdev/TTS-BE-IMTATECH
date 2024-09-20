<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'is.admin'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('order')->as('order.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::put('{order}', [OrderController::class, 'update'])->name('update');
            Route::get('detail/{order}', [OrderController::class, 'detail'])->name('detail');
        });

        Route::prefix('catalogues')
            ->as('catalogues.')
            ->group(function () {
                Route::get('/',                [CatalogueController::class, 'index'])->name('index');
                Route::post('store',           [CatalogueController::class, 'store'])->name('store');
                Route::put('/{id}',      [CatalogueController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy',     [CatalogueController::class, 'destroy'])->name('destroy');
            });

        Route::resource('products', ProductController::class);

        Route::resource('users', UserController::class);

        Route::resource('banners', BannerController::class);

        Route::resource('coupon', CouponController::class);

        Route::prefix('comment')->as('comments.')->group(function () {
            Route::get('/', [CommentController::class, 'index'])->name('index');
            Route::post('sort-delete/{comment}', [CommentController::class, 'sortDelete'])->name('sortdelete');
            Route::post('restore/{id}', [CommentController::class, 'restore'])->name('restore');
        });

        Route::prefix('product/colors')
            ->as('product.colors.')
            ->group(function () {
                Route::get('/', [ProductColorController::class, 'index'])->name('index');
                Route::post('/store', [ProductColorController::class, 'store'])->name('store');
                Route::put('/{id}', [ProductColorController::class, 'update'])->name('update');
                Route::delete('{id}/delete', [ProductColorController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('product/sizes')
            ->as('product.sizes.')
            ->group(function () {
                Route::get('/', [ProductSizeController::class, 'index'])->name('index');
                Route::post('/store', [ProductSizeController::class, 'store'])->name('store');
                Route::put('/{id}', [ProductSizeController::class, 'update'])->name('update');
                Route::delete('{id}/delete', [ProductSizeController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('product/tags')
            ->as('product.tags.')
            ->group(function () {
                Route::get('/', [TagController::class, 'index'])->name('index');
                Route::post('/store', [TagController::class, 'store'])->name('store');
                Route::put('/{id}', [TagController::class, 'update'])->name('update');
                Route::delete('{id}/delete', [TagController::class, 'destroy'])->name('destroy');
            });
    });

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showFormLogin'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
