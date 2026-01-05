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

        // 1. Fetch Presensi - Use database assessments
        $now = \Carbon\Carbon::now();
        $presensiAssessments = \App\Models\PresensiAssessment::where('user_id', $id)
            ->where('month', $now->month)
            ->where('year', $now->year)
            ->get();
        
        $presensiScore = 0;
        if ($presensiAssessments->isNotEmpty()) {
            $hCount = $presensiAssessments->where('status', 'H')->count();
            $presensiScore = round(($hCount / $presensiAssessments->count()) * 100);
        }

        // 2. Fetch FMD - Use total score from MTK as representative
        $fmdAssessment = \App\Models\FmdAssessment::where('user_id', $id)->where('type', 'mtk')->first();
        $fmdScore = $fmdAssessment ? round(($fmdAssessment->total_score / 5) * 100) : 0; // Mock % based on 5 weeks

        // 3. Wawancara - Fetch from DB
        $wawancaraAssessment = \App\Models\WawancaraAssessment::where('user_id', $id)->first();
        $wawancaraScore = $wawancaraAssessment->percent ?? 0;

        // 4. Nilai Akhir - Use FinalAssessment table
        $finalAssessment = \App\Models\FinalAssessment::where('user_id', $id)->first();
        $nilaiAkhirScore = $finalAssessment->rata_rata ?? 0;

        return view('sensei.evaluasi.detail.siswa.seleksi', compact(
            'student', 
            'kanjiAssessments', 
            'kotobaAssessments', 
            'bunpouAssessment',
            'presensiScore',
            'fmdScore',
            'wawancaraScore',
            'wawancaraAssessment',
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

        // Stats calculation
        $totalBab = 34;
        $completedCount = $assessments->count();
        $avgScore = $completedCount > 0 ? round($assessments->avg('score'), 1) : 0;
        $passCount = $assessments->where('score', '>=', 75)->count();
        $passRate = $completedCount > 0 ? round(($passCount / $completedCount) * 100, 1) : 0;

        // Prepare Matrix (Bab 1-34)
        $matrix = [];
        $keyedAssessments = $assessments->keyBy('bab');
        for ($i = 1; $i <= $totalBab; $i++) {
            $matrix[$i] = $keyedAssessments->get($i);
        }

        $stats = [
            'completed' => $completedCount,
            'avg_score' => $avgScore,
            'pass_count' => $passCount,
            'pass_rate' => $passRate,
            'total_bab' => $totalBab
        ];

        return view('sensei.evaluasi.detail.siswa.nilai_kanji', compact('student', 'assessments', 'stats', 'matrix'));
    }
}
