<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TurnstileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class KaryawanAuthController extends Controller
{
    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
            'cf-turnstile-response' => 'required',
        ]);

        // Verify Turnstile
        $turnstile = new TurnstileService();
        if (!$turnstile->verify($request->input('cf-turnstile-response'), $request->ip())) {
            return back()->withErrors(['captcha' => 'Verifikasi keamanan gagal. Silakan coba lagi.'])->withInput();
        }

        $admin = \App\Models\Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'karyawan',
        ]);

        Auth::guard('karyawan')->login($admin);

        return redirect('/');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'cf-turnstile-response' => 'required',
        ]);

        // Verify Turnstile
        $turnstile = new TurnstileService();
        if (!$turnstile->verify($request->input('cf-turnstile-response'), $request->ip())) {
            return back()->withErrors(['captcha' => 'Verifikasi keamanan gagal. Silakan coba lagi.'])->withInput();
        }

        $credentials = $request->only(['email', 'password']);
        $remember = $request->boolean('remember');

        if (Auth::guard('karyawan')->attempt($credentials, $remember)) {
            $user = Auth::guard('karyawan')->user();
            
            if ($user->role === 'karyawan') {
                $request->session()->regenerate();
                return redirect()->intended('/');
            } else {
                Auth::guard('karyawan')->logout();
                return back()->withErrors(['email' => 'Anda tidak memiliki akses sebagai karyawan'])->withInput();
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('karyawan')->logout();
        // Do not invalidate session to allow concurrent logins
        return redirect()->route('login.portal');
    }
}
