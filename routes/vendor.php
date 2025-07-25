<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\ProductController;

Route::prefix('vendor')->middleware(['auth', 'vendor'])->name('vendor.')->group(function () {

    // لوحة تحكم البائع
    Route::get('/dashboard', function () {
        return view('vendor.dashboard.index');
    })->name('dashboard');

    // إدارة المنتجات
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');       
        Route::put('/{product}/restore', [ProductController::class, 'restore'])->name('restore');
        Route::delete('/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('forceDelete');

    });


});
