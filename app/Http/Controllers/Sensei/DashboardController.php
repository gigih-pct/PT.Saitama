<?php

namespace App\Http\Controllers\Sensei;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the Sensei dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $total_kelas = \App\Models\Kelas::count();
        $total_siswa = \App\Models\User::where('role', 'siswa')->count();
        
        // Average scores simulation from database
        $avg_kanji = \App\Models\KanjiAssessment::avg('score') ?? 0;
        $avg_kotoba = \App\Models\KotobaAssessment::avg('score') ?? 0;
        $avg_bunpou = \App\Models\BunpouAssessment::avg('final_nilai') ?? 0;
        $avg_wawancara = \App\Models\WawancaraAssessment::avg('percent') ?? 0;
        
        $avg_bahasa = round(($avg_kanji + $avg_kotoba + $avg_bunpou) / 3, 1);
        $avg_sikap = $avg_wawancara >= 85 ? 'A' : ($avg_wawancara >= 75 ? 'B' : 'C');
        
        // Attendance simulation (Since no presence table yet, simulate based on student status/engagement)
        $kehadiran = 85; // Placeholder for now or calculate from some metric
        
        // Chart data simulation
        $chart_data = [
            'labels' => ['Minggu 2','Minggu 4','Minggu 6','Minggu 8','Minggu 10','Minggu 12','Minggu 14','Minggu 16'],
            'bahasa' => [65, 70, 72, 75, 78, 80, 82, 85],
            'fmd' => [80, 82, 85, 83, 85, 88, 90, 88]
        ];

        return view('sensei.dashboard', compact(
            'total_kelas', 
            'total_siswa', 
            'avg_bahasa', 
            'avg_sikap', 
            'kehadiran',
            'chart_data'
        ));
    }
}
