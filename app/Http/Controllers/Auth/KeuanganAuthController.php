<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TurnstileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class KeuanganAuthController extends Controller
{
    public function registerStore(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
            'cf-turnstile-response' => 'required',
        ];

        $data = $request->validate($rules);

        // Verify Turnstile
        $turnstile = new TurnstileService();
        if (!$turnstile->verify($request->input('cf-turnstile-response'), $request->ip())) {
            return back()->withErrors(['captcha' => 'Verifikasi keamanan gagal. Silakan coba lagi.'])->withInput();
        }

        $admin = \App\Models\Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'Keuangan',
        ]);

        Auth::guard('keuangan')->login($admin);

        return redirect()->route('keuangan.dashboard');
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

        if (Auth::guard('keuangan')->attempt($credentials, $remember)) {
            $user = Auth::guard('keuangan')->user();
            
            if ($user->role === 'Keuangan') {
                $request->session()->regenerate();
                return redirect()->route('keuangan.dashboard');
            } else {
                Auth::guard('keuangan')->logout();
                return back()->withErrors(['email' => 'Anda tidak memiliki akses sebagai Keuangan.'])->withInput();
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('keuangan')->logout();
        // Do not invalidate session to allow concurrent logins
        return redirect()->route('login.portal');
    }
}
