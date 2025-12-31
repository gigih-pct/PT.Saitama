<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Berkas;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_siswa' => User::where('role', 'siswa')->count(),
            'total_kelas' => Kelas::count(),
            'berkas_pending' => Berkas::where('status', 'pending')->count(),
            'berkas_pendaftaran' => Berkas::where('jenis_berkas', 'pendaftaran')->where('status', 'pending')->count(),
            'berkas_seleksi' => Berkas::where('jenis_berkas', 'seleksi')->where('status', 'pending')->count(),
        ];

        $latest_pendaftaran = Berkas::with('user')
            ->where('jenis_berkas', 'pendaftaran')
            ->orderBy('uploaded_at', 'desc')
            ->take(3)
            ->get();

        $latest_seleksi = Berkas::with('user')
            ->where('jenis_berkas', 'seleksi')
            ->orderBy('uploaded_at', 'desc')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_pendaftaran', 'latest_seleksi'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . Auth::guard('admin')->id(),
            'password' => 'nullable|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
