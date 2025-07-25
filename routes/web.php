<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// ✅ الصفحة الرئيسية العامة
Route::get('/', function () {
    return view('site.pages.home');
})->name('home');

// ✅ توجيه بعد تسجيل الدخول حسب الدور
Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'admin'    => redirect()->route('admin.dashboard'),
        'vendor'   => redirect()->route('vendor.dashboard'),
        'customer' => redirect()->route('home'), 
        default    => redirect()->route('home'),
    };
})->middleware(['auth'])->name('dashboard');

// ✅ ملف التعريف الشخصي (مشترك)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/admin.php';
require __DIR__.'/vendor.php';
require __DIR__.'/customer.php';
require __DIR__.'/auth.php';
 