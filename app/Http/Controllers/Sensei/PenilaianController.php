<?php

namespace App\Http\Controllers\Sensei;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\BunpouAssessment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenilaianController extends Controller
{
    public function show($type, Request $request)
    {
        $validTypes = ['kanji', 'bunpou', 'kotoba', 'fmd', 'wawancara', 'presensi', 'nilai-akhir'];
        if (!in_array($type, $validTypes)) {
            abort(404);
        }

        // Classes for dropdown
        $kelases = Kelas::orderBy('nama_kelas')->get();
        
        // Determine selected class
        $selectedKelasId = $request->query('kelas_id');
        if (!$selectedKelasId) {
            $selectedKelasId = session('selected_kelas_id');
        }
        
        if (!$selectedKelasId && $kelases->count() > 0) {
            $selectedKelasId = $kelases->first()->id;
        }
        
        if ($selectedKelasId) {
            session(['selected_kelas_id' => $selectedKelasId]);
        }

        // Fetch students filtered by class
        $students = User::where('role', 'siswa')
            ->when($selectedKelasId, function($q) use ($selectedKelasId) {
                return $q->where('kelas_id', $selectedKelasId);
            })
            ->orderBy('name')
            ->get();

        $viewName = "sensei.penilaian-{$type}";

        // Specific Data Setup
        $data = [
            'students' => $students,
            'type' => $type,
            'kelases' => $kelases,
            'selectedKelasId' => $selectedKelasId
        ];

        if ($type === 'kanji') {
            $bab = $request->query('bab', '1');
            $questionsMap = [
                '1' => 15, '2' => 12, '3' => 18, '4' => 25, '5-6' => 20,
                '7' => 13, '8' => 19, '9' => 9, '10' => 14, '11' => 26,
                '12-13' => 14, '14' => 13, '15' => 14, '16' => 13, '17' => 24,
                '18' => 7, '19' => 17, '20-21' => 14, '22-23' => 11, '24-25' => 12,
                '26' => 17, '27' => 13, '28' => 17, '29' => 9, '30' => 10,
                '31' => 8, '32' => 9, '33' => 8, '34-35' => 11
            ];
            $data['selectedBab'] = $bab;
            $data['questionsCount'] = $questionsMap[$bab] ?? 10;
            $data['questionsMap'] = $questionsMap;
            
            // Load existing scores from session
            $saved = session('penilaian_kanji_bab_' . $bab);
            $data['savedScores'] = $saved ?? [];
            $data['summary'] = session('penilaian_kanji_summary_bab_' . $bab, ['total'=>$students->count(), 'lulus'=>0, 'percent'=>0]);
        }
            if ($type === 'kotoba') {
            $bab = $request->query('bab', '1');
            $questionsMap = [
                '1' => 35, '2' => 59, '3' => 59, '4' => 59, '5' => 59, '6' => 59,
                '7' => 59, '8' => 41, '9' => 41, '10' => 22, '11' => 22, '12' => 22,
                '13' => 16, '14' => 37, '15' => 54, '16' => 47, '17' => 44, '18' => 26,
                '19' => 28, '20' => 35, '21' => 31, '22' => 26, '23' => 22, '24' => 34,
                '25' => 16, '26' => 35, '27' => 37, '28' => 43, '29' => 33, '30' => 33,
                '31' => 34, '32' => 25, '33' => 31, '34' => 11
            ];
            $data['selectedBab'] = $bab;
            $data['questionsCount'] = $questionsMap[$bab] ?? 35;
            $data['questionsMap'] = $questionsMap;
            
            // Load existing scores from session
            $saved = session('penilaian_kotoba_bab_' . $bab);
            $data['savedScores'] = $saved ?? [];
            $data['summary'] = session('penilaian_kotoba_summary_bab_' . $bab, ['total'=>$students->count(), 'lulus'=>0, 'percent'=>0]);
        }
        if ($type === 'bunpou') {
            $evaParam = $request->query('eva', '1');
            $isFinal = ($evaParam === 'final');
            $evaIndex = $isFinal ? null : intval($evaParam);
            
            if (!$isFinal && ($evaIndex < 1 || $evaIndex > 6)) {
                $evaIndex = 1;
            }

            $assessments = BunpouAssessment::whereIn('user_id', $students->pluck('id'))->get()->keyBy('user_id');
            
            $saved = [];
            $lulus = 0;
            
            if ($isFinal) {
                $fieldUjian = "final_ujian";
                $fieldNilai = "final_nilai";
                $fieldAt = "final_at";

                foreach ($students as $student) {
                    $assessment = $assessments->get($student->id);
                    if ($assessment) {
                        $vUjian = $assessment->{$fieldUjian};
                        $vNilai = $assessment->{$fieldNilai};
                        $vAt = $assessment->{$fieldAt};

                        $saved[$student->id] = [
                            'ujian' => $vUjian,
                            'nilai' => $vNilai,
                            'at' => $vAt,
                        ];

                        if ($vUjian !== null && $vNilai !== null && $vUjian >= 75 && $vNilai >= 75) {
                            $lulus++;
                        }
                    }
                }
                $data['evaParam'] = 'final';
                $data['evaLabel'] = "Penilaian Akhir";
            } else {
                $scoreField = "eval{$evaIndex}";
                $atField = "eval{$evaIndex}_at";

                foreach ($students as $student) {
                    $assessment = $assessments->get($student->id);
                    if ($assessment) {
                        $scoreValue = $assessment->{$scoreField};
                        $dateValue = $assessment->{$atField};
                        
                        $saved[$student->id] = [
                            'score' => $scoreValue,
                            'at' => $dateValue,
                        ];
                        
                        if ($scoreValue !== null && $scoreValue >= 75) {
                            $lulus++;
                        }
                    }
                }
                $data['evaParam'] = (string)$evaIndex;
                $data['evaLabel'] = "Evaluasi {$evaIndex}";
            }
            
            $data['savedScores'] = $saved;
            $data['evaIndex'] = $evaIndex; // might be null for final
            
            $total = $students->count();
            $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
            $data['summary'] = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent];
        }
        
        if ($type === 'presensi') {
            $month = $request->query('month', date('n'));
            $year = $request->query('year', date('Y'));
            $daysInMonth = Carbon::create($year, $month)->daysInMonth;
            $days = range(1, $daysInMonth);
            
            $data['month'] = $month;
            $data['year'] = $year;
            $data['days'] = $days;
            $data['daysCount'] = $daysInMonth;
            
            $sessionKey = "penilaian_presensi_{$year}_{$month}_kelas_{$selectedKelasId}";
            $saved = session($sessionKey);
            $data['savedScores'] = $saved ?? [];
            
            $summaryKey = "penilaian_presensi_summary_{$year}_{$month}_kelas_{$selectedKelasId}";
            $data['summary'] = session($summaryKey, ['H' => 0, 'A' => 0, 'S' => 0, 'I' => 0]);
            
            $countsPerDayKey = "penilaian_presensi_counts_per_day_{$year}_{$month}_kelas_{$selectedKelasId}";
            $data['counts_per_day'] = session($countsPerDayKey, []);
        }

        return view($viewName, $data);
    }

    public function saveKanji(Request $request)
{
    try {
        $bab = (string)$request->input('bab', '1');
        $payload = $request->input('students', []);
        
        $questionsMap = [
            '1' => 15, '2' => 12, '3' => 18, '4' => 25, '5-6' => 20,
            '7' => 13, '8' => 19, '9' => 9, '10' => 14, '11' => 26,
            '12-13' => 14, '14' => 13, '15' => 14, '16' => 13, '17' => 24,
            '18' => 7, '19' => 17, '20-21' => 14, '22-23' => 11, '24-25' => 12,
            '26' => 17, '27' => 13, '28' => 17, '29' => 9, '30' => 10,
            '31' => 8, '32' => 9, '33' => 8, '34-35' => 11
        ];

        $questions = $questionsMap[$bab] ?? 10;

            // Logic to calculate scores
            $clean = [];
            $lulus = 0;
            
            foreach ($payload as $s) {
                // $s contains 'id', 'correct', etc.
                $correct = intval($s['correct'] ?? 0);
                $correct = max(0, min($correct, $questions));
                $score = $questions ? round(($correct / $questions) * 100, 2) : 0;
                
                $clean[$s['id']] = [
                    'correct' => $correct,
                    'score' => $score,
                    'date' => $s['date'] ?? now()->format('Y-m-d')
                ];
                
                if ($score >= 75) $lulus++;
            }

            // Save using Student ID as key to be consistent
            session(['penilaian_kanji_bab_' . $bab => $clean]);

            $total = count($clean); // or count($students)
            $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
            $summary = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent];
            
            session(['penilaian_kanji_summary_bab_' . $bab => $summary]);

            return response()->json(['success' => true, 'summary' => $summary]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function resetKanji(Request $request)
    {
        $bab = (string)$request->input('bab', '1');
        session()->forget('penilaian_kanji_bab_' . $bab);
        session()->forget('penilaian_kanji_summary_bab_' . $bab);
        return response()->json(['success' => true]);
    }

    public function saveKotoba(Request $request)
    {
        try {
            $bab = (string)$request->input('bab', '1');
            $payload = $request->input('students', []);
            
            $questionsMap = [
                '1' => 35, '2' => 59, '3' => 59, '4' => 59, '5' => 59, '6' => 59,
                '7' => 59, '8' => 41, '9' => 41, '10' => 22, '11' => 22, '12' => 22,
                '13' => 16, '14' => 37, '15' => 54, '16' => 47, '17' => 44, '18' => 26,
                '19' => 28, '20' => 35, '21' => 31, '22' => 26, '23' => 22, '24' => 34,
                '25' => 16, '26' => 35, '27' => 37, '28' => 43, '29' => 33, '30' => 33,
                '31' => 34, '32' => 25, '33' => 31, '34' => 11
            ];

            $questions = $questionsMap[$bab] ?? 35;

            $clean = [];
            $lulus = 0;
            
            foreach ($payload as $s) {
                if (empty($s['name'])) continue;
                $correct = intval($s['correct'] ?? 0);
                $correct = max(0, min($correct, $questions));
                $score = $questions ? round(($correct / $questions) * 100, 2) : 0;
                
                $clean[] = [
                    'name' => $s['name'],
                    'correct' => $correct,
                    'score' => $score,
                    'date' => $s['date'] ?? now()->format('Y-m-d')
                ];
                
                if ($score >= 75) $lulus++;
            }

            session(['penilaian_kotoba_bab_' . $bab => $clean]);

            $total = count($clean);
            $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
            $summary = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent];
            
            session(['penilaian_kotoba_summary_bab_' . $bab => $summary]);

            return response()->json(['success' => true, 'summary' => $summary]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function resetKotoba(Request $request)
    {
        $bab = (string)$request->input('bab', '1');
        session()->forget('penilaian_kotoba_bab_' . $bab);
        session()->forget('penilaian_kotoba_summary_bab_' . $bab);
        return response()->json(['success' => true]);
    }

    public function saveBunpou(Request $request)
    {
        try {
            $payload = $request->input('students', []);
            $evaParam = $request->input('eva', '1');
            $isFinal = ($evaParam === 'final');

            $lulus = 0;
            $total = 0;

            DB::beginTransaction();
            foreach ($payload as $s) {
                $userId = $s['user_id'] ?? null;
                if (!$userId) continue;

                if ($isFinal) {
                    $scoreUjian = isset($s['ujian']) ? floatval($s['ujian']) : null;
                    $scoreNilai = isset($s['nilai']) ? floatval($s['nilai']) : null;
                    $at = $s['at'] ?? null;

                    if ($scoreUjian !== null) $scoreUjian = max(0, min(100, $scoreUjian));
                    if ($scoreNilai !== null) $scoreNilai = max(0, min(100, $scoreNilai));

                    BunpouAssessment::updateOrCreate(
                        ['user_id' => $userId],
                        [
                            'final_ujian' => $scoreUjian,
                            'final_nilai' => $scoreNilai,
                            'final_at' => $at,
                        ]
                    );

                    if ($scoreUjian !== null && $scoreNilai !== null && $scoreUjian >= 75 && $scoreNilai >= 75) {
                        $lulus++;
                    }
                } else {
                    $evaIndex = intval($evaParam);
                    if ($evaIndex < 1 || $evaIndex > 6) $evaIndex = 1;

                    $scoreField = "eval{$evaIndex}";
                    $atField = "eval{$evaIndex}_at";

                    $score = isset($s['score']) ? floatval($s['score']) : null;
                    $at = $s['at'] ?? null;

                    if ($score !== null) $score = max(0, min(100, $score));

                    BunpouAssessment::updateOrCreate(
                        ['user_id' => $userId],
                        [
                            $scoreField => $score,
                            $atField => $at,
                        ]
                    );

                    if ($score !== null && $score >= 75) $lulus++;
                }
                $total++;
            }
            DB::commit();

            $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
            $summary = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent];

            return response()->json(['success' => true, 'summary' => $summary]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function resetBunpou(Request $request)
    {
        try {
            $selectedKelasId = session('selected_kelas_id');
            if (!$selectedKelasId) {
                return response()->json(['success' => false, 'message' => 'Kelas belum dipilih.'], 400);
            }
            
            $evaParam = $request->input('eva', '1');
            $studentIds = User::where('kelas_id', $selectedKelasId)->where('role', 'siswa')->pluck('id');

            if ($evaParam === 'final') {
                BunpouAssessment::whereIn('user_id', $studentIds)->update([
                    'final_ujian' => null,
                    'final_nilai' => null,
                    'final_at' => null,
                ]);
            } else {
                $evaIndex = intval($evaParam);
                $scoreField = "eval{$evaIndex}";
                $atField = "eval{$evaIndex}_at";

                BunpouAssessment::whereIn('user_id', $studentIds)->update([
                    $scoreField => null,
                    $atField => null,
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function savePresensi(Request $request)
    {
        try {
            $students = $request->input('students', []);
            $month = $request->input('month', date('n'));
            $year = $request->input('year', date('Y'));
            $selectedKelasId = session('selected_kelas_id');
            
            if (!$selectedKelasId) {
                return response()->json(['success' => false, 'message' => 'Kelas tidak terdeteksi.'], 400);
            }

            $daysInMonth = Carbon::create($year, $month)->daysInMonth;
            $allowed = ['H', 'A', 'S', 'I'];
            $clean = [];

            foreach ($students as $s) {
                $name = trim($s['name'] ?? '');
                if ($name === '') continue;
                $phone = trim($s['phone'] ?? '');
                $statuses = array_values($s['statuses'] ?? []);
                $statuses = array_slice($statuses, 0, $daysInMonth);
                $statuses = array_pad($statuses, $daysInMonth, '');
                $statuses = array_map(function ($v) use ($allowed) {
                    $c = strtoupper((string)($v ?? ''));
                    return in_array($c, $allowed) ? $c : '';
                }, $statuses);

                $clean[] = ['name' => $name, 'phone' => $phone, 'statuses' => $statuses];
            }

            $sessionKey = "penilaian_presensi_{$year}_{$month}_kelas_{$selectedKelasId}";
            session([$sessionKey => $clean]);

            $counts = ['H' => 0, 'A' => 0, 'S' => 0, 'I' => 0];
            $perDay = [];
            for ($d = 0; $d < $daysInMonth; $d++) {
                $perDay[$d] = ['counts' => ['H' => 0, 'A' => 0, 'S' => 0, 'I' => 0], 'students' => []];
            }

            foreach ($clean as $st) {
                foreach ($st['statuses'] as $idx => $s) {
                    if (in_array($s, $allowed)) {
                        $counts[$s]++;
                        $perDay[$idx]['counts'][$s]++;
                    }
                    $perDay[$idx]['students'][] = ['name' => $st['name'], 'phone' => $st['phone'], 'status' => $s];
                }
            }

            $summaryKey = "penilaian_presensi_summary_{$year}_{$month}_kelas_{$selectedKelasId}";
            session([$summaryKey => $counts]);

            $countsPerDayKey = "penilaian_presensi_counts_per_day_{$year}_{$month}_kelas_{$selectedKelasId}";
            session([$countsPerDayKey => $perDay]);

            return response()->json([
                'success' => true,
                'saved' => count($clean),
                'counts' => $counts,
                'counts_per_day' => $perDay
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function resetPresensi(Request $request)
    {
        try {
            $month = $request->input('month', date('n'));
            $year = $request->input('year', date('Y'));
            $selectedKelasId = session('selected_kelas_id');

            if (!$selectedKelasId) {
                return response()->json(['success' => false, 'message' => 'Kelas tidak terdeteksi.'], 400);
            }

            $sessionKey = "penilaian_presensi_{$year}_{$month}_kelas_{$selectedKelasId}";
            $summaryKey = "penilaian_presensi_summary_{$year}_{$month}_kelas_{$selectedKelasId}";
            $countsPerDayKey = "penilaian_presensi_counts_per_day_{$year}_{$month}_kelas_{$selectedKelasId}";

            session()->forget($sessionKey);
            session()->forget($summaryKey);
            session()->forget($countsPerDayKey);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
