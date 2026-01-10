<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'captcha' => 'required|captcha',
        ];

        $data = $request->validate($rules);

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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'captcha' => 'required|captcha',
        ]);

        $remember = $request->boolean('remember');

        unset($credentials['captcha']);

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
