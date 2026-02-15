<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TurnstileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CrmAuthController extends Controller
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
            'role' => 'CRM',
        ]);

        Auth::guard('crm')->login($admin);

        return redirect()->route('crm.dashboard');
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

        if (Auth::guard('crm')->attempt($credentials, $remember)) {
            $user = Auth::guard('crm')->user();
            
            if ($user->role === 'CRM') {
                $request->session()->regenerate();
                return redirect()->route('crm.dashboard');
            } else {
                Auth::guard('crm')->logout(); // Logout if role is not CRM
                return back()->withErrors(['email' => 'Anda tidak memiliki akses CRM'])->withInput();
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('crm')->logout();
        // Do not invalidate session to allow concurrent logins
        return redirect()->route('login.portal');
    }
}
