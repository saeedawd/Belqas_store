<?php

use Illuminate\Support\Facades\Route;

Route::prefix('customer')->middleware(['auth', 'customer'])->group(function () {
    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    // تقدر تضيف مسارات العميل هنا
});
