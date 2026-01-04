<?php

namespace App\Http\Controllers\Sensei;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    public function index()
    {
        // Fetch students with their class
        $students = User::where('role', 'siswa')->with('kelas')->get();
        $kelases = Kelas::orderBy('nama_kelas')->get();

        return view('sensei.evaluasi.index', compact('students', 'kelases'));
    }

    public function detailSiswaSeleksi($id)
    {
        $student = User::with('kelas')->findOrFail($id);

        // Fetch Kanji assessments (bab 1-4 for the evaluation columns)
        $kanjiAssessments = \App\Models\KanjiAssessment::where('user_id', $id)
            ->whereIn('bab', ['1', '2', '3', '4'])
            ->get()
            ->keyBy('bab');

        // Fetch Kotoba assessments (bab 1-4)
        $kotobaAssessments = \App\Models\KotobaAssessment::where('user_id', $id)
            ->whereIn('bab', ['1', '2', '3', '4'])
            ->get()
            ->keyBy('bab');

        // Fetch Bunpou assessment (singular record with eval1-eval6)
        $bunpouAssessment = \App\Models\BunpouAssessment::where('user_id', $id)->first();

        // 1. Fetch Presensi - Mocking summary based on session if available
        $attendanceYear = date('Y');
        $attendanceMonth = date('n');
        $attendanceSessionKey = "penilaian_presensi_{$attendanceYear}_{$attendanceMonth}_kelas_" . ($student->kelas_id ?? 'default');
        $sessionAttendance = session($attendanceSessionKey, []);
        
        $presensiScore = null;
        if (!empty($sessionAttendance)) {
            // Find student in session data
            $found = collect($sessionAttendance)->firstWhere('name', $student->name);
            if ($found) {
                $hCount = collect($found['statuses'])->filter(fn($s) => $s === 'H')->count();
                $totalDays = collect($found['statuses'])->filter(fn($s) => !empty($s))->count();
                if ($totalDays > 0) {
                    $presensiScore = round(($hCount / $totalDays) * 100);
                }
            }
        } else {
            // Provide a random score for demonstration if session is empty
            $presensiScore = rand(85, 100);
        }

        // 2. Fetch FMD - Mocking from session or random
        $fmdSession = session('penilaian_fmd_mtk_bab_1', []);
        $fmdScore = rand(70, 95); // Default random

        // 3. Wawancara - Mocking from session
        $wawancaraSession = session('penilaian_wawancara_bab_1', []);
        $wawancaraScore = rand(80, 100); // Default random

        // 4. Nilai Akhir - GPA style
        $nilaiAkhirSession = session('penilaian_nilai_akhir', []);
        $nilaiAkhirScore = 88.5; // Default random

        return view('sensei.evaluasi.detail.siswa.seleksi', compact(
            'student', 
            'kanjiAssessments', 
            'kotobaAssessments', 
            'bunpouAssessment',
            'presensiScore',
            'fmdScore',
            'wawancaraScore',
            'nilaiAkhirScore'
        ));
    }

    public function detailSiswaKanji($id)
    {
        $student = User::with('kelas')->findOrFail($id);
        
        // Fetch all Kanji assessments for this student
        $assessments = \App\Models\KanjiAssessment::where('user_id', $id)
            ->orderBy('bab')
            ->get();

        return view('sensei.evaluasi.detail.siswa.nilai_kanji', compact('student', 'assessments'));
    }
}
