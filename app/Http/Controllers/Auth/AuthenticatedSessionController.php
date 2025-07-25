<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $role = auth()->user()->role;

        $redirectTo = match ($role) {
            'admin' => route('admin.dashboard'),
            'vendor' => route('vendor.dashboard'),
            default => '/',
        };

        return redirect()->intended($redirectTo);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        // تسجيل الخروج من جميع الجلسات الأخرى
        if ($user && $request->has('password') && Hash::check($request->input('password'), $user->password)) {
            Auth::logoutOtherDevices($request->input('password'));
        }

        // تسجيل الخروج من الجلسة الحالية
        Auth::guard('web')->logout();

        // حذف جميع الجلسات من قاعدة البيانات (اختياري، أكثر أمانًا)
        if (config('session.driver') === 'database') {
            DB::table('sessions')->where('user_id', $user->id)->delete();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // إعادة التوجيه بعد تسجيل الخروج
        return redirect('/'); // الصفحة الرئيسية تعرض index.blade.php
    }
}
