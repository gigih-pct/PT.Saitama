<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TurnstileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class OrangtuaAuthController extends Controller
{
    public function registerStore(Request $request)
    {
        $hasRole = Schema::hasColumn('users', 'role');

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'cf-turnstile-response' => 'required',
        ];

        if ($hasRole) {
            $rules['role'] = 'required|in:siswa,orangtua';
        }

        $data = $request->validate($rules);

        // Verify Turnstile
        $turnstile = new TurnstileService();
        if (!$turnstile->verify($request->input('cf-turnstile-response'), $request->ip())) {
            return back()->withErrors(['captcha' => 'Verifikasi keamanan gagal. Silakan coba lagi.'])->withInput();
        }

        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];

        if ($hasRole) {
            $userData['role'] = $data['role'];
        }

        $user = User::create($userData);

        Auth::guard('orangtua')->login($user);

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

        if (Auth::guard('orangtua')->attempt($credentials, $remember)) {
            $user = Auth::guard('orangtua')->user();
            
            if ($user->role === 'orangtua') {
                $request->session()->regenerate();
                return redirect()->route('orangtua.dashboard');
            } else {
                Auth::guard('orangtua')->logout();
                return back()->withErrors(['email' => 'Anda tidak memiliki akses sebagai orangtua.'])->withInput();
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('orangtua')->logout();
        // Do not invalidate session to allow concurrent logins
        return redirect()->route('login.portal');
    }
}
