<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TurnstileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SenseiAuthController extends Controller
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
            $rules['role'] = 'required|in:sensei';
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

        Auth::guard('sensei')->login($user);

        return redirect()->route('sensei.index');
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

        try {
            if (Auth::guard('sensei')->attempt($credentials, $remember)) {
                $user = Auth::guard('sensei')->user();
                
                if ($user->role === 'sensei') {
                    $request->session()->regenerate();
                    return redirect()->intended(route('sensei.index'));
                }
                // If the user is authenticated but their role is not 'sensei',
                // log them out from this guard and proceed to the error message.
                Auth::guard('sensei')->logout();
            }
        } catch (\RuntimeException $e) {
            Log::warning('Unsupported password hash format for user login attempt', [
                'email' => $request->input('email'),
                'exception' => $e->getMessage(),
            ]);

            return back()->withErrors(['email' => 'Akun memiliki format kata sandi yang tidak didukung. Silakan reset kata sandi atau hubungi admin.'])->withInput();
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('sensei')->logout();
        // Do not invalidate session to allow concurrent logins
        return redirect()->route('login.portal');
    }
}
