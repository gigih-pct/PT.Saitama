<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class KaryawanAuthController extends Controller
{
    public function registerStore(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ];

        $data = $request->validate($rules);

        $admin = \App\Models\Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'karyawan',
        ]);

        Auth::guard('karyawan')->login($admin);

        return redirect('/');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

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
