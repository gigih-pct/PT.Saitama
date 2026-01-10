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
            'siswa_pending' => User::where('role', 'siswa')->where('status', 'pending')->count(),
            'total_kelas' => Kelas::count(),
            'berkas_pending' => Berkas::where('status', 'pending')->count(),
            'berkas_pendaftaran' => Berkas::where('jenis_berkas', 'pendaftaran')->where('status', 'pending')->count(),
            'berkas_seleksi' => Berkas::where('jenis_berkas', 'seleksi')->where('status', 'pending')->count(),
        ];

        // Advanced Stats for Document Management
        $doc_pendaftaran = [
            'pending' => Berkas::where('jenis_berkas', 'pendaftaran')->where('status', 'pending')->count(),
            'approved' => Berkas::where('jenis_berkas', 'pendaftaran')->where('status', 'approved')->count(),
            'rejected' => Berkas::where('jenis_berkas', 'pendaftaran')->where('status', 'rejected')->count(),
        ];
        $doc_seleksi = [
            'pending' => Berkas::where('jenis_berkas', 'seleksi')->where('status', 'pending')->count(),
            'approved' => Berkas::where('jenis_berkas', 'seleksi')->where('status', 'approved')->count(),
            'rejected' => Berkas::where('jenis_berkas', 'seleksi')->where('status', 'rejected')->count(),
        ];

        // Mock Attendance Stats (Table not created yet)
        $attendance_stats = [
            'percentage' => 92,
            'points' => 1240,
            'trend_up' => true,
            'details' => [
                ['label' => 'Hadir', 'count' => 1420, 'color' => 'bg-emerald-500'],
                ['label' => 'Izin', 'count' => 45, 'color' => 'bg-blue-500'],
                ['label' => 'Sakit', 'count' => 12, 'color' => 'bg-amber-500'],
                ['label' => 'Alfa', 'count' => 4, 'color' => 'bg-rose-500'],
            ]
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

        // Fetch registration trend (Last 365 days)
        $endDate = now();
        $startDate = now()->subDays(365);
        
        $registrations = User::where('role', 'siswa')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('count', 'date');

        // Fill missing dates with 0
        $trend_data = [];
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dateStr = $currentDate->format('Y-m-d');
            $trend_data[] = [
                'date' => $dateStr,
                'count' => $registrations[$dateStr] ?? 0
            ];
            $currentDate->addDay();
        }

        return view('admin.dashboard', compact(
            'stats', 
            'latest_pendaftaran', 
            'latest_seleksi', 
            'trend_data',
            'doc_pendaftaran',
            'doc_seleksi',
            'attendance_stats'
        ));
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
