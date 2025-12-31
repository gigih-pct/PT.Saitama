<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CRMController extends Controller
{
    public function dashboard()
    {
        // Fetch all students (role = siswa)
        $students = User::where('role', 'siswa')->with('kelas')->get();
        
        // Define color mapping for statuses (harmonized with Alpine.js)
        $statusColors = [
            'Jepang' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
            'seleksi' => 'bg-blue-50 text-[#173A67] border-blue-100',
            'mau seleksi' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
            'ulang kelas' => 'bg-amber-50 text-amber-600 border-amber-100',
            'BLK' => 'bg-orange-50 text-orange-600 border-orange-100',
            'proses belajar' => 'bg-cyan-50 text-cyan-600 border-cyan-100',
            'TG' => 'bg-violet-50 text-violet-600 border-violet-100',
            'kerja' => 'bg-sky-50 text-sky-600 border-sky-100',
            'keluar' => 'bg-rose-50 text-rose-600 border-rose-100',
            'cuti' => 'bg-slate-50 text-slate-600 border-slate-100',
            'Respon' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
            'No Respon' => 'bg-rose-50 text-rose-600 border-rose-100',
            'Invalid' => 'bg-gray-50 text-gray-400 border-gray-100',
        ];

        // Transform students for Alpine.js
        $students = $students->map(function ($student) use ($statusColors) {
            return [
                'name' => $student->name,
                'angkatan' => $student->kelas ? $student->kelas->nama_kelas : 'Umum',
                'fuDate' => $student->created_at->format('d/m/Y'),
                'response' => $student->follow_up ?: 'No Respon',
                'responseColor' => $statusColors[$student->follow_up] ?? 'bg-gray-50 text-gray-400 border-gray-100',
                'class' => $student->status ?: 'Pending',
                'classColor' => $statusColors[$student->status] ?? 'bg-gray-50 text-gray-400 border-gray-100',
                'contacts' => [
                    'siswa' => [$student->no_wa_pribadi ?: '-'],
                    'ortu' => [$student->wa_orang_tua ?: '-']
                ]
            ];
        });

        return view('CRM.dashboard', [
            'students' => $students,
            'totalStudents' => $students->count(),
            'targetStudents' => 80,
        ]);
    }

    public function kesiswaan()
    {
        // Fetch all students (role = siswa)
        $students = User::where('role', 'siswa')->with('kelas')->get();
        
        $statusColors = [
            'Jepang' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
            'seleksi' => 'bg-blue-50 text-[#173A67] border-blue-100',
            'mau seleksi' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
            'ulang kelas' => 'bg-amber-50 text-amber-600 border-amber-100',
            'BLK' => 'bg-orange-50 text-orange-600 border-orange-100',
            'proses belajar' => 'bg-cyan-50 text-cyan-600 border-cyan-100',
            'TG' => 'bg-violet-50 text-violet-600 border-violet-100',
            'kerja' => 'bg-sky-50 text-sky-600 border-sky-100',
            'keluar' => 'bg-rose-50 text-rose-600 border-rose-100',
            'cuti' => 'bg-slate-50 text-slate-600 border-slate-100',
            'Respon' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
            'No Respon' => 'bg-rose-50 text-rose-600 border-rose-100',
            'Invalid' => 'bg-gray-50 text-gray-400 border-gray-100',
        ];

        $students = $students->map(function ($student) use ($statusColors) {
            return [
                'name' => $student->name,
                'angkatan' => $student->kelas ? $student->kelas->nama_kelas : 'Umum',
                'fuDate' => $student->created_at->format('d/m/Y'),
                'status1' => $student->follow_up ?: 'No Respon',
                'status1Color' => $statusColors[$student->follow_up] ?? 'bg-gray-50 text-gray-400 border-gray-100',
                'status2' => $student->status ?: 'Pending',
                'status2Color' => $statusColors[$student->status] ?? 'bg-gray-50 text-gray-400 border-gray-100',
                'contacts' => [
                    'siswa' => [$student->no_wa_pribadi ?: '-'],
                    'ortu' => [$student->wa_orang_tua ?: '-']
                ]
            ];
        });

        return view('CRM.kesiswaan', ['students' => $students]);
    }

    public function pengajuansiswa()
    {
        return view('CRM.pengajuansiswa');
    }

    public function datakelas()
    {
        return view('CRM.datakelas');
    }

    public function testimoni()
    {
        return view('CRM.testimoni');
    }

    public function detailkesiswaan()
    {
        return view('CRM.detailkesiswaan');
    }
}
