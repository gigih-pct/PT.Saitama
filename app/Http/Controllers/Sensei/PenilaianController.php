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
use App\Models\KanjiAssessment;
use App\Models\KotobaAssessment;
use App\Models\FmdAssessment;
use App\Models\PresensiAssessment;
use App\Models\FinalAssessment;

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
            // Load existing scores from DB
            $kanjiAssessments = KanjiAssessment::whereIn('user_id', $students->pluck('id'))
                ->where('bab', $bab)
                ->get()
                ->keyBy('user_id');

            $saved = [];
            $lulus = 0;
            $count = 0;

            foreach ($students as $student) {
                if ($assessment = $kanjiAssessments->get($student->id)) {
                    $saved[] = [
                        'score' => $assessment->score,
                        'correct' => $assessment->correct,
                        'date' => $assessment->date,
                        'name' => $student->name // Assuming name needed for alignment, or just rely on index alignment in view? 
                        // View uses $rows[$idx]. If $rows is array of DB records, index might not match $students iteration if filtered.
                        // The current view logic tries `isset($rows[$idx])`. This is fragile if $rows comes from DB->get().
                        // Better to key by user_id in view?
                        // View: $saved = isset($rows[$idx]) ? $rows[$idx] : null;
                        // The previous session implementation stored strict array aligned with students (or ID keyed?).
                        // Previous Code: `session(['penilaian_kanji_bab_' . $bab => $clean]);` where $clean was keyed by ID: `$clean[$s['id']] = ...`
                        // So in view: `$rows = $savedScores` (which is $clean).
                        // View: `isset($rows[$idx])` -> wait, if $rows is keyed by ID, `$idx` (loop index 0,1,2..) won't match ID (1, 5, 10..).
                        // Let's check previous saveKanji: `$clean[$s['id']] = ...`.
                        // But wait, the VIEW uses `$idx`: `@forelse($users as $idx => $user)` ... `isset($rows[$idx])`.
                        // This implies existing code might be buggy or I misread `saveKanji`.
                        // Previous `saveKanji`: `$clean[$s['id']] = ...`.
                        // View line 111: `$saved = isset($rows[$idx]) ? $rows[$idx] : null;`
                        // If `$rows` is keyed by UserID, `$rows[$idx]` is WRONG unless UserIDs are 0,1,2... which they aren't.
                        // UNLESS `$rows` was just a plain array?
                        // Previous `saveKanji`: `$clean[$s['id']] = ...` -> Associative array.
                        // If passing to view: `$rows = session(...)`.
                        // If `$rows` is `['101' => {...}, '102' => {...}]`. `$idx` is 0. `$rows[0]` is undefined.
                        // So the CURRENT/OLD implementation might be broken or I am missing something about `$idx`.
                        // Ah, maybe `$users` collection keys are IDs? Reference: `$users = User::...->get()`. `get()` returns Collection, keys are 0,1,2...
                        // So `$idx` is 0,1,2.
                        // So previous `saveKanji` producing `[$id => data]` would fail to load in view using `$idx`.
                        
                        // Wait, looking at current `saveKanji` (line 219):
                        // `$clean[$s['id']] = ...`
                        // So it saves by ID.
                        // View line 111: `$saved = isset($rows[$idx]) ? $rows[$idx] : null;`
                        // This looks strictly BROKEN in the current file if keys are IDs.
                        // Unless `$rows` is not what I think it is.
                        // Let's look at `penilaian-kanji.blade.php`.
                        // Line 11: `$rows = $savedScores ?? [];`
                        // Line 111: `$saved = isset($rows[$idx]) ? $rows[$idx] : null;`
                        // If I change backend to return keyed by `idx` (0,1,2) it matches view. 
                        // BUT `user` list might change order/count. ID is safer.
                        // I will fix the View logic too if needed, OR I will make sure `$rows` is keyed by `$student->id` and I update View to use `$rows[$user->id]`.
                        // BUT I cannot easily update View in the same step if I want to be safe.
                        // Actually, I can update View to usage `$rows[$user->id]` which is much robust.
                        // Let's see if I can do that. view is `penilaian-kanji.blade.php`.
                        // User request: "buatkan database".
                        // I should probably fix the View to look up by ID.
                    ];
                }
            }
            // Re-map to be keyed by ID for safer lookup, or list matching $students order?
            // Let's pass a Keyed array to view: $data['savedScores'] = $kanjiAssessments->toArray(); (Keyed by ID because of keyBy('user_id') above?)
            // `keyBy` returns collection keyed by ID. `toArray` preserves keys? Yes.
            // So `$savedScores` is `[1 => {...}, 2 => {...}]`.
            // I need to update VIEW to use `$rows[$user->id]`.
            
            $data['savedScores'] = $kanjiAssessments->toArray();
            
            // Calculate summary
            $total = $students->count();
            $lulusCount = $kanjiAssessments->filter(fn($a) => $a->score >= 75)->count();
            $percent = $total ? round(($lulusCount / $total) * 100, 2) : 0;
            
            $data['summary'] = ['total'=>$total, 'lulus'=>$lulusCount, 'percent'=>$percent];
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
            
            // Load existing scores from DB
            $kotobaAssessments = KotobaAssessment::whereIn('user_id', $students->pluck('id'))
                ->where('bab', $bab)
                ->get()
                ->keyBy('user_id');

            $data['savedScores'] = $kotobaAssessments->toArray();

            // Calculate summary
            $total = $students->count();
            $lulusCount = $kotobaAssessments->filter(fn($a) => $a->score >= 75)->count();
            $percent = $total ? round(($lulusCount / $total) * 100, 2) : 0;
            
            $data['summary'] = ['total'=>$total, 'lulus'=>$lulusCount, 'percent'=>$percent];
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
        
        if ($type === 'fmd') {
            $mode = $request->query('mode', 'mtk');
            $data['mode'] = $mode;
            
            $assessments = FmdAssessment::whereIn('user_id', $students->pluck('id'))
                ->where('type', $mode)
                ->get()
                ->keyBy('user_id');
            
            $data['savedScores'] = $assessments->toArray();
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
            
            $assessments = PresensiAssessment::whereIn('user_id', $students->pluck('id'))
                ->where('month', $month)
                ->where('year', $year)
                ->get()
                ->groupBy('user_id');

            $formatted = [];
            foreach ($students as $student) {
                $userAss = $assessments->get($student->id, collect());
                $statuses = array_fill(0, $daysInMonth, '');
                foreach ($userAss as $ass) {
                    if ($ass->day <= $daysInMonth) {
                        $statuses[$ass->day - 1] = $ass->status;
                    }
                }
                $formatted[$student->id] = [
                    'name' => $student->name,
                    'phone' => $userAss->first()->phone ?? $student->no_wa_pribadi ?? '-',
                    'statuses' => $statuses
                ];
            }
            
            $data['savedScores'] = $formatted;
            
            // Summary
            $counts = ['H' => 0, 'A' => 0, 'S' => 0, 'I' => 0];
            $perDay = [];
            for ($d = 0; $d < $daysInMonth; $d++) {
                $perDay[$d] = ['counts' => ['H' => 0, 'A' => 0, 'S' => 0, 'I' => 0], 'students' => []];
            }

            foreach ($formatted as $uId => $st) {
                foreach ($st['statuses'] as $dayIdx => $s) {
                    if (isset($counts[$s])) {
                        $counts[$s]++;
                        $perDay[$dayIdx]['counts'][$s]++;
                    }
                    $perDay[$dayIdx]['students'][] = ['name' => $st['name'], 'phone' => $st['phone'], 'status' => $s];
                }
            }

            $data['summary'] = $counts;
            $data['counts_per_day'] = $perDay;
        }

        if ($type === 'nilai-akhir') {
            $assessments = FinalAssessment::whereIn('user_id', $students->pluck('id'))
                ->get()
                ->keyBy('user_id');
            
            $data['savedScores'] = $assessments->toArray();

            // Summary
            $total = $students->count();
            $lulus = $assessments->filter(fn($a) => $a->rata_rata >= 75)->count();
            $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
            $data['summary_lolos'] = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent];
        }

        if ($type === 'wawancara') {
            $assessments = \App\Models\WawancaraAssessment::whereIn('user_id', $students->pluck('id'))
                ->get()
                ->keyBy('user_id');
            
            $data['savedScores'] = $assessments->toArray();

            // Calculate summary
            $total = $students->count();
            $lulusCount = $assessments->filter(fn($a) => $a->percent >= 75)->count();
            $percent = $total ? round(($lulusCount / $total) * 100, 2) : 0;
            
            $data['summary'] = ['total' => $total, 'lulus' => $lulusCount, 'percent' => $percent];
        }

        return view($viewName, $data);
    }

    public function saveWawancara(Request $request)
    {
        try {
            $students = $request->input('students', []);
            if (!is_array($students) || count($students) === 0) {
                return response()->json(['success' => false, 'message' => 'Tidak ada data siswa untuk disimpan.'], 422);
            }

            DB::beginTransaction();
            foreach ($students as $s) {
                $userId = $s['id'] ?? null;
                if (!$userId) continue;

                $program = isset($s['program']) ? intval($s['program']) : 0;
                $umum = isset($s['umum']) ? intval($s['umum']) : 0;
                $jepang = isset($s['jepang']) ? intval($s['jepang']) : 0;
                $indo = isset($s['indo']) ? intval($s['indo']) : 0;
                $note = trim($s['note'] ?? '');
                $sum = $program + $umum + $jepang + $indo;
                $percent = $sum ? round(($sum / 12) * 100, 2) : 0;

                // Sikap fields
                $cara_duduk = isset($s['cara_duduk']) ? intval($s['cara_duduk']) : 0;
                $suara = isset($s['suara']) ? intval($s['suara']) : 0;
                $fokus = isset($s['fokus']) ? intval($s['fokus']) : 0;
                $note_sikap = trim($s['note_sikap'] ?? '');
                $sum_sikap = $cara_duduk + $suara + $fokus;
                $percent_sikap = $sum_sikap ? round(($sum_sikap / 9) * 100, 2) : 0;

                \App\Models\WawancaraAssessment::updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'program' => $program,
                        'umum' => $umum,
                        'jepang' => $jepang,
                        'indo' => $indo,
                        'sum' => $sum,
                        'percent' => $percent,
                        'note' => $note,
                        'cara_duduk' => $cara_duduk,
                        'suara' => $suara,
                        'fokus' => $fokus,
                        'sum_sikap' => $sum_sikap,
                        'percent_sikap' => $percent_sikap,
                        'note_sikap' => $note_sikap,
                        'date' => Carbon::now(),
                    ]
                );
            }
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            DB::rollBack();
            logger()->error('Wawancara save failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Server error saat menyimpan.'], 500);
        }
    }

    public function resetWawancara(Request $request)
    {
        try {
            $selectedKelasId = session('selected_kelas_id');
            if (!$selectedKelasId) {
                return response()->json(['success' => false, 'message' => 'Kelas tidak terdeteksi.'], 400);
            }

            $studentIds = User::where('role', 'siswa')
                ->where('kelas_id', $selectedKelasId)
                ->pluck('id');

            \App\Models\WawancaraAssessment::whereIn('user_id', $studentIds)->delete();

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            logger()->error('Wawancara reset failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Server error saat reset.'], 500);
        }
    }

    public function saveKanji(Request $request)
    {
        try {
            $bab = (int)$request->input('bab', '1');
            $payload = $request->input('students', []);
            $selectedKelasId = session('selected_kelas_id');
            
            \Illuminate\Support\Facades\Log::info("SaveKanji HIT: " . json_encode([
                'bab' => $bab,
                'class_id' => $selectedKelasId,
                'payload_count' => count($payload),
                'session_keys' => array_keys(session()->all())
            ]));

            if (!$selectedKelasId) {
                \Illuminate\Support\Facades\Log::warning("SaveKanji Failed: No Class ID");
                return response()->json(['success' => false, 'message' => 'Kelas tidak terdeteksi.'], 400);
            }
            
            $questionsMap = [
                '1' => 15, '2' => 12, '3' => 18, '4' => 25, '5-6' => 20,
                '7' => 13, '8' => 19, '9' => 9, '10' => 14, '11' => 26,
                '12-13' => 14, '14' => 13, '15' => 14, '16' => 13, '17' => 24,
                '18' => 7, '19' => 17, '20-21' => 14, '22-23' => 11, '24-25' => 12,
                '26' => 17, '27' => 13, '28' => 17, '29' => 9, '30' => 10,
                '31' => 8, '32' => 9, '33' => 8, '34-35' => 11
            ];

            $questions = $questionsMap[(string)$bab] ?? 10;
            
            DB::beginTransaction();
            foreach ($payload as $s) {
                 $userId = $s['user_id'] ?? $s['id'] ?? null;
                 if (!$userId) continue; 
                 
                 $correct = intval($s['correct'] ?? 0);
                 $correct = max(0, min($correct, $questions));
                 $score = $questions ? round(($correct / $questions) * 100, 2) : 0;
                 $date = $s['date'] ?? now()->format('Y-m-d');
 
                 KanjiAssessment::updateOrCreate(
                     ['user_id' => $userId, 'bab' => $bab],
                     [
                         'correct' => $correct,
                         'score' => $score,
                         'date' => $date
                     ]
                 );
             }
             DB::commit();
             
             // Recalculate summary based on ACTUAL class data
             $studentIds = User::where('kelas_id', $selectedKelasId)->where('role', 'siswa')->pluck('id');
             $total = $studentIds->count();
             
             $lulus = KanjiAssessment::whereIn('user_id', $studentIds)
                ->where('bab', $bab)
                ->where('score', '>=', 75)
                ->count();

             $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
             $summary = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent];
 
             return response()->json(['success' => true, 'summary' => $summary]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function resetKanji(Request $request)
    {
        try {
            $bab = (int)$request->input('bab', '1');
            $selectedKelasId = session('selected_kelas_id');
            
            if ($selectedKelasId) {
                // Reset only for this class? Or assume reset means for currently displayed students?
                // The safest is to reset by user IDs present in the class.
                $studentIds = User::where('kelas_id', $selectedKelasId)->where('role', 'siswa')->pluck('id');
                KanjiAssessment::whereIn('user_id', $studentIds)
                    ->where('bab', $bab)
                    ->delete();
            } else {
                 // Fallback if no class selected (shouldn't happen per logic)
                 // Maybe risky to delete all?
                 // Let's rely on frontend context or just don't delete if no class.
                 return response()->json(['success' => false, 'message' => 'Kelas tidak terdeteksi'], 400);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function saveKotoba(Request $request)
    {
        try {
            $bab = (string)$request->input('bab', '1');
            $payload = $request->input('students', []);
            $selectedKelasId = session('selected_kelas_id');
            
            \Illuminate\Support\Facades\Log::info("SaveKotoba HIT: " . json_encode([
                'bab' => $bab,
                'class_id' => $selectedKelasId,
                'payload_count' => count($payload)
            ]));

            if (!$selectedKelasId) {
                return response()->json(['success' => false, 'message' => 'Kelas tidak terdeteksi.'], 400);
            }
            
            $questionsMap = [
                '1' => 35, '2' => 59, '3' => 59, '4' => 59, '5' => 59, '6' => 59,
                '7' => 59, '8' => 41, '9' => 41, '10' => 22, '11' => 22, '12' => 22,
                '13' => 16, '14' => 37, '15' => 54, '16' => 47, '17' => 44, '18' => 26,
                '19' => 28, '20' => 35, '21' => 31, '22' => 26, '23' => 22, '24' => 34,
                '25' => 16, '26' => 35, '27' => 37, '28' => 43, '29' => 33, '30' => 33,
                '31' => 34, '32' => 25, '33' => 31, '34' => 11
            ];

            $questions = $questionsMap[$bab] ?? 35;

            DB::beginTransaction();
            foreach ($payload as $s) {
                 $userId = $s['user_id'] ?? $s['id'] ?? null;
                 if (!$userId) continue; 
                 
                 $correct = intval($s['correct'] ?? 0);
                 $correct = max(0, min($correct, $questions));
                 $score = $questions ? round(($correct / $questions) * 100, 2) : 0;
                 $date = $s['date'] ?? now()->format('Y-m-d');

                 KotobaAssessment::updateOrCreate(
                     ['user_id' => $userId, 'bab' => $bab],
                     [
                         'correct' => $correct,
                         'score' => $score,
                         'date' => $date
                     ]
                 );
            }
             DB::commit();
             
             // Recalculate summary
             $studentIds = User::where('kelas_id', $selectedKelasId)->where('role', 'siswa')->pluck('id');
             $total = $studentIds->count();
             
             $lulus = KotobaAssessment::whereIn('user_id', $studentIds)
                ->where('bab', $bab)
                ->where('score', '>=', 75)
                ->count();

             $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
             $summary = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent];

             return response()->json(['success' => true, 'summary' => $summary]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function resetKotoba(Request $request)
    {
        try {
            $bab = (string)$request->input('bab', '1');
            $selectedKelasId = session('selected_kelas_id');
            
            if ($selectedKelasId) {
                $studentIds = User::where('kelas_id', $selectedKelasId)->where('role', 'siswa')->pluck('id');
                KotobaAssessment::whereIn('user_id', $studentIds)
                    ->where('bab', $bab)
                    ->delete();
            } else {
                 return response()->json(['success' => false, 'message' => 'Kelas tidak terdeteksi'], 400);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
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
            $month = intval($request->input('month', date('n')));
            $year = intval($request->input('year', date('Y')));
            $selectedKelasId = session('selected_kelas_id');
            
            if (!$selectedKelasId) {
                return response()->json(['success' => false, 'message' => 'Kelas tidak terdeteksi.'], 400);
            }

            DB::beginTransaction();
            foreach ($students as $s) {
                $userId = $s['id'] ?? null;
                if (!$userId) continue;
                
                $phone = trim($s['phone'] ?? '');
                $statuses = $s['statuses'] ?? [];

                foreach ($statuses as $dayIdx => $status) {
                    $day = $dayIdx + 1;
                    $status = strtoupper(trim($status));
                    if (!in_array($status, ['H', 'A', 'S', 'I'])) $status = null;

                    PresensiAssessment::updateOrCreate(
                        ['user_id' => $userId, 'day' => $day, 'month' => $month, 'year' => $year],
                        ['status' => $status, 'phone' => $phone, 'date' => "{$year}-{$month}-{$day}"]
                    );
                }
            }
            DB::commit();

            // Recalculate summary for the response
            $allStudents = User::where('role', 'siswa')->where('kelas_id', $selectedKelasId)->get();
            $assessments = PresensiAssessment::whereIn('user_id', $allStudents->pluck('id'))
                ->where('month', $month)
                ->where('year', $year)
                ->get()
                ->groupBy('user_id');

            $daysInMonth = Carbon::create($year, $month)->daysInMonth;
            $counts = ['H' => 0, 'A' => 0, 'S' => 0, 'I' => 0];
            $perDay = [];
            for ($d = 0; $d < $daysInMonth; $d++) {
                $perDay[$d] = ['counts' => ['H' => 0, 'A' => 0, 'S' => 0, 'I' => 0], 'students' => []];
            }

            foreach ($allStudents as $student) {
                $userAss = $assessments->get($student->id, collect());
                foreach ($userAss as $ass) {
                    if ($ass->day <= $daysInMonth && $ass->status) {
                        $s = $ass->status;
                        if (isset($counts[$s])) {
                            $counts[$s]++;
                            $perDay[$ass->day - 1]['counts'][$s]++;
                        }
                        $perDay[$ass->day - 1]['students'][] = [
                            'name' => $student->name,
                            'phone' => $ass->phone ?? $student->no_wa_pribadi ?? '-',
                            'status' => $s
                        ];
                    }
                }
            }

            return response()->json([
                'success' => true,
                'counts' => $counts,
                'counts_per_day' => $perDay,
                'saved' => $allStudents->count()
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function resetPresensi(Request $request)
    {
        try {
            $month = intval($request->input('month', date('n')));
            $year = intval($request->input('year', date('Y')));
            $selectedKelasId = session('selected_kelas_id');

            if (!$selectedKelasId) {
                return response()->json(['success' => false, 'message' => 'Kelas tidak terdeteksi.'], 400);
            }

            $studentIds = User::where('kelas_id', $selectedKelasId)->where('role', 'siswa')->pluck('id');

            PresensiAssessment::whereIn('user_id', $studentIds)
                ->where('month', $month)
                ->where('year', $year)
                ->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function saveFmd(Request $request)
    {
        try {
            $students = $request->input('students', []);
            $mode = $request->input('mode', 'mtk');

            DB::beginTransaction();
            foreach ($students as $s) {
                $userId = $s['id'] ?? null;
                if (!$userId) continue;

                $data = [
                    'total_score' => 0,
                    'date' => Carbon::now(),
                ];

                for ($w = 1; $w <= 5; $w++) {
                    $val = $s["week{$w}_val"] ?? null;
                    $ket = $s["week{$w}_ket"] ?? null;
                    $score = intval($s["week{$w}_score"] ?? 0);
                    
                    $data["week{$w}_val"] = $val;
                    $data["week{$w}_ket"] = $ket;
                    $data["week{$w}_score"] = $score;
                    $data['total_score'] += $score;
                }

                FmdAssessment::updateOrCreate(
                    ['user_id' => $userId, 'type' => $mode],
                    $data
                );
            }
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function resetFmd(Request $request)
    {
        try {
            $mode = $request->input('mode', 'mtk');
            $selectedKelasId = session('selected_kelas_id');

            if (!$selectedKelasId) {
                return response()->json(['success' => false, 'message' => 'Kelas tidak terdeteksi.'], 400);
            }

            $studentIds = User::where('kelas_id', $selectedKelasId)->where('role', 'siswa')->pluck('id');

            FmdAssessment::whereIn('user_id', $studentIds)
                ->where('type', $mode)
                ->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function saveNilaiAkhir(Request $request)
    {
        try {
            $students = $request->input('students', []);

            DB::beginTransaction();
            foreach ($students as $s) {
                $userId = $s['id'] ?? null;
                if (!$userId) continue;

                $subjects = ['hiragana', 'katakana', 'bunpou', 'kerja', 'sifat', 'benda', 'terjemah', 'dengar', 'bicara'];
                $data = [];
                $sum = 0;
                $count = 0;

                foreach ($subjects as $sub) {
                    $val = isset($s[$sub]) ? intval($s[$sub]) : null;
                    $data[$sub] = $val;
                    if ($val !== null) {
                        $sum += $val;
                        $count++;
                    }
                }

                $rataRata = $count > 0 ? $sum / $count : 0;
                $grade = 'TU';
                if ($rataRata >= 90) $grade = 'A';
                elseif ($rataRata >= 85) $grade = 'B+';
                elseif ($rataRata >= 80) $grade = 'B';
                elseif ($rataRata >= 75) $grade = 'C+';
                elseif ($rataRata >= 10) $grade = 'C';

                $data['sikap'] = $s['sikap'] ?? null;
                $data['kehadiran'] = isset($s['kehadiran']) ? floatval($s['kehadiran']) : 0;
                $data['rata_rata'] = $rataRata;
                $data['grade'] = $grade;
                $data['date'] = Carbon::now();

                FinalAssessment::updateOrCreate(
                    ['user_id' => $userId],
                    $data
                );
            }
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function resetNilaiAkhir(Request $request)
    {
        try {
            $selectedKelasId = session('selected_kelas_id');

            if (!$selectedKelasId) {
                return response()->json(['success' => false, 'message' => 'Kelas tidak terdeteksi.'], 400);
            }

            $studentIds = User::where('kelas_id', $selectedKelasId)->where('role', 'siswa')->pluck('id');

            FinalAssessment::whereIn('user_id', $studentIds)->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function statusSiswa()
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
                'id' => $student->id,
                'name' => $student->name,
                'angkatan' => $student->kelas ? $student->kelas->nama_kelas : 'Umum',
                'kelas_id' => $student->kelas_id,
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

        return view('sensei.statussiswa', ['students' => $students]);
    }

    public function updateStudentStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255'
        ]);

        $student = User::findOrFail($id);
        $student->status = $request->status;
        $student->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diupdate',
            'data' => [
                'id' => $student->id,
                'status' => $student->status
            ]
        ]);
    }

    public function updateStudentFollowUp(Request $request, $id)
    {
        $request->validate([
            'follow_up' => 'required|string|max:255'
        ]);

        $student = User::findOrFail($id);
        $student->follow_up = $request->follow_up;
        $student->save();

        return response()->json([
            'success' => true,
            'message' => 'Follow up berhasil diupdate',
            'data' => [
                'id' => $student->id,
                'follow_up' => $student->follow_up
            ]
        ]);
    }

    public function updateStudentBatch(Request $request, $id)
    {
        $request->validate([
            'angkatan' => 'required|string|max:255'
        ]);

        $student = User::findOrFail($id);
        
        // Find kelas by nama_kelas
        $kelas = \App\Models\Kelas::where('nama_kelas', $request->angkatan)->first();
        
        if ($kelas) {
            $student->kelas_id = $kelas->id;
            $student->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Angkatan berhasil diupdate',
            'data' => [
                'id' => $student->id,
                'angkatan' => $request->angkatan,
                'kelas_id' => $student->kelas_id
            ]
        ]);
    }
}
