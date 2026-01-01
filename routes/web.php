<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login.portal');
});

Route::get('/portal', fn () => view('auth.portal'))->name('login.portal');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Generic logout route for any authenticated user/guard
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    // Redirect users to the main login page after logout
    return redirect()->route('login');
})->name('logout');

// CAPTCHA Reload Route
// CAPTCHA Reload Route
Route::get('/refresh-captcha', function () {
    return response()->json(['captcha' => captcha_img('flat')]);
})->name('captcha.reload');

use App\Http\Controllers\Sensei\DashboardController;
use App\Http\Controllers\Sensei\EvaluasiController;

// For now require only authentication; the `role` middleware isn't registered
// which causes a container error when resolving `role`. Add role checks later.
Route::middleware(['auth'])
    ->prefix('sensei')
    ->name('sensei.')
    ->group(function () {
        // Allow visiting /sensei to show the dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('index');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        
        // Penilaian routes (different assessment types)
        Route::get('/penilaian-kelas', fn () => view('sensei.penilaian-presensi'))
            ->name('penilaian');
        Route::get('/penilaian-kelas/preensi-siswa', fn () => view('sensei.penilaian-presensi'))
            ->name('penilaian.presensi');

        // Save presensi (stores session data for now)
        Route::post('/penilaian-kelas/preensi-siswa/save', function (Request $request) {
            $students = $request->input('students', []);
            $daysCount = 30;
            $allowed = ['H','A','S','I'];
            $clean = [];

            foreach ($students as $s) {
                $name = trim($s['name'] ?? '');
                if ($name === '') continue; // skip empty rows
                $phone = trim($s['phone'] ?? '');
                $statuses = array_values($s['statuses'] ?? []);

                // normalize and sanitize statuses to exactly $daysCount entries
                $statuses = array_slice($statuses, 0, $daysCount);
                $statuses = array_pad($statuses, $daysCount, '');
                $statuses = array_map(function ($v) use ($allowed) {
                    $c = strtoupper((string)($v ?? ''));
                    return in_array($c, $allowed) ? $c : '';
                }, $statuses);

                $clean[] = [ $name, $phone, $statuses ];
            }

            session(['penilaian_presensi' => $clean]);

            // compute counts for H/A/S/I across all saved students
            $counts = ['H' => 0, 'A' => 0, 'S' => 0, 'I' => 0];

            $daysCount = 30;
            // initialize per-day structure
            $perDay = [];
            for ($d = 0; $d < $daysCount; $d++) {
                $perDay[$d] = [ 'counts' => ['H' => 0, 'A' => 0, 'S' => 0, 'I' => 0], 'students' => [] ];
            }

            foreach ($clean as $st) {
                if(isset($st[2]) && is_array($st[2])) {
                    foreach ($st[2] as $s) {
                        $c = strtoupper((string)($s ?? ''));
                        if(in_array($c, array_keys($counts))) {
                            $counts[$c] = ($counts[$c] ?? 0) + 1;
                        }
                    }
                }

                // also collect per-day info
                $name = $st[0] ?? '';
                $phone = $st[1] ?? '';
                for ($d = 0; $d < $daysCount; $d++) {
                    $stval = strtoupper((string)($st[2][$d] ?? ''));
                    if(in_array($stval, ['H','A','S','I'])) {
                        $perDay[$d]['counts'][$stval] = ($perDay[$d]['counts'][$stval] ?? 0) + 1;
                    }
                    $perDay[$d]['students'][] = [ 'name' => $name, 'phone' => $phone, 'status' => $stval ];
                }
            }

            session(['penilaian_presensi_counts' => $counts, 'penilaian_presensi_counts_per_day' => $perDay]);

            return response()->json(['success' => true, 'saved' => count($clean), 'counts' => $counts, 'counts_per_day' => $perDay]);
        })->name('penilaian.presensi.save');

        // Reset saved presensi
        Route::post('/penilaian-kelas/preensi-siswa/reset', function (Request $request) {
            session()->forget('penilaian_presensi');
            session()->forget('penilaian_presensi_counts');
            session()->forget('penilaian_presensi_counts_per_day');
            return response()->json(['success' => true]);
        })->name('penilaian.presensi.reset');
        Route::get('/penilaian-kelas/bunpou', fn () => view('sensei.penilaian-bunpou'))
            ->name('penilaian.bunpou');

        // Support both /penilaian-kelas and /penilaian-kelas/kanji for Kanji page
        Route::get('/penilaian-kelas/kanji', fn () => view('sensei.penilaian-kanji'))
            ->name('penilaian.kanji');

        // Kanji save/reset routes (per-bab)
        Route::post('/penilaian-kelas/kanji/save', function (Request $request) {
            try {
                $bab = intval($request->input('bab', 1));
                $students = $request->input('students', []);

                // Temporary debug logging to help diagnose client issues
                logger()->info('Kanji save request', ['bab' => $bab, 'students' => $students, 'ip' => $request->ip(), 'user_id' => auth()->check() ? auth()->id() : null]);

                if(!is_array($students) || count($students) === 0) {
                    return response()->json(['success' => false, 'message' => 'Tidak ada data siswa untuk disimpan.'], 422);
                }

                // map of question counts per bab
                $map = [1 => 15, 2 => 12, 3 => 18, 4 => 25];
                $questions = $map[$bab] ?? 10;

                $clean = [];
                $return = [];
                foreach ($students as $s) {
                    $name = trim($s['name'] ?? '');
                    $correctRaw = isset($s['correct']) ? $s['correct'] : null;
                    $hasContent = $name !== '' || ($correctRaw !== null && $correctRaw !== '');
                    if (!$hasContent) continue; // skip truly empty rows
                    $correct = intval($correctRaw ?? 0);
                    $correct = max(0, min($correct, $questions));
                    $date = trim($s['date'] ?? '');
                    $rowIdx = isset($s['row']) ? intval($s['row']) : null;
                    $score = $questions ? round(($correct / $questions) * 100, 2) : 0;
                    $clean[] = ['name' => $name, 'correct' => $correct, 'score' => $score, 'date' => $date];
                    $return[] = ['row' => $rowIdx, 'name' => $name, 'correct' => $correct, 'score' => $score, 'date' => $date];
                }

                session(['penilaian_kanji_bab_' . $bab => $clean]);

                // summary
                $total = count($clean);
                $lulus = 0;
                foreach ($clean as $c) { if (($c['score'] ?? 0) >= 75) $lulus++; }
                $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
                $summary = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent, 'questions' => $questions, 'bab' => $bab];
                session(['penilaian_kanji_summary_bab_' . $bab => $summary]);

                return response()->json(['success' => true, 'saved' => $total, 'summary' => $summary, 'students' => $return]);
            } catch (\Throwable $e) {
                // Log server error and return JSON
                logger()->error('Kanji save failed: ' . $e->getMessage(), ['exception' => $e]);
                // If debug mode enabled, include exception message to aid debugging locally
                $resp = ['success' => false, 'message' => 'Server error saat menyimpan.'];
                if(config('app.debug')) { $resp['error'] = $e->getMessage(); }
                return response()->json($resp, 500);
            }
        })->name('penilaian.kanji.save');

        Route::post('/penilaian-kelas/kanji/reset', function (Request $request) {
            try {
                $bab = intval($request->input('bab', 1));
                session()->forget('penilaian_kanji_bab_' . $bab);
                session()->forget('penilaian_kanji_summary_bab_' . $bab);
                return response()->json(['success' => true]);
            } catch (\Throwable $e) {
                logger()->error('Kanji reset failed: ' . $e->getMessage(), ['exception' => $e]);
                return response()->json(['success' => false, 'message' => 'Server error saat reset.'], 500);
            }
        })->name('penilaian.kanji.reset');

        // Save bunpou scores (store in session for now)
        Route::post('/penilaian-kelas/bunpou/save', function (Request $request) {
            $students = $request->input('students', []);
            $clean = [];
            foreach ($students as $s) {
                $name = trim($s['name'] ?? '');
                if ($name === '') continue; // skip empty rows
                $eval1 = isset($s['eval1']) ? floatval($s['eval1']) : null;
                $eval2 = isset($s['eval2']) ? floatval($s['eval2']) : null;
                $date = trim($s['date'] ?? '');
                // clamp scores
                if($eval1 !== null) $eval1 = max(0, min(100, $eval1));
                if($eval2 !== null) $eval2 = max(0, min(100, $eval2));
                $clean[] = ['name' => $name, 'eval1' => $eval1, 'eval2' => $eval2, 'date' => $date];
            }

            session(['penilaian_bunpou' => $clean]);

            // compute summary
            $total = count($clean);
            $lulus = 0;
            foreach ($clean as $c) {
                $e1 = $c['eval1']; $e2 = $c['eval2'];
                if($e1 !== null && $e2 !== null && $e1 >= 75 && $e2 >= 75) $lulus++;
            }
            $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
            $summary = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent];
            session(['penilaian_bunpou_summary' => $summary]);

            return response()->json(['success' => true, 'saved' => $total, 'summary' => $summary, 'students' => $clean]);
        })->name('penilaian.bunpou.save');

        // Reset bunpou
        Route::post('/penilaian-kelas/bunpou/reset', function (Request $request) {
            session()->forget('penilaian_bunpou');
            session()->forget('penilaian_bunpou_summary');
            return response()->json(['success' => true]);
        })->name('penilaian.bunpou.reset');
        Route::get('/penilaian-kelas/kotoba', fn () => view('sensei.penilaian-kotoba'))
            ->name('penilaian.kotoba');
        Route::get('/penilaian-kelas/wawancara', fn () => view('sensei.penilaian-wawancara'))
            ->name('penilaian.wawancara');

        // Wawancara save/reset
        Route::post('/penilaian-kelas/wawancara/save', function (Request $request) {
            try {
                $students = $request->input('students', []);
                if(!is_array($students) || count($students) === 0) {
                    return response()->json(['success' => false, 'message' => 'Tidak ada data siswa untuk disimpan.'], 422);
                }

                $clean = [];
                $return = [];
                foreach ($students as $s) {
                    $rowIdx = isset($s['row']) ? intval($s['row']) : null;
                    $program = isset($s['program']) ? intval($s['program']) : 0;
                    $umum = isset($s['umum']) ? intval($s['umum']) : 0;
                    $jepang = isset($s['jepang']) ? intval($s['jepang']) : 0;
                    $indo = isset($s['indo']) ? intval($s['indo']) : 0;
                    $note = trim($s['note'] ?? '');
                    $sum = $program + $umum + $jepang + $indo;
                    $percent = $sum ? round(($sum / 12) * 100, 2) : 0;
                    if($program === 0 && $umum === 0 && $jepang === 0 && $indo === 0 && $note === '') continue;
                    $clean[] = ['row' => $rowIdx, 'program'=>$program,'umum'=>$umum,'jepang'=>$jepang,'indo'=>$indo,'sum'=>$sum,'percent'=>$percent,'note'=>$note];
                    $return[] = ['row' => $rowIdx, 'program'=>$program,'umum'=>$umum,'jepang'=>$jepang,'indo'=>$indo,'sum'=>$sum,'percent'=>$percent,'note'=>$note];
                }

                session(['penilaian_wawancara_bab_1' => $clean]);

                $total = count($clean);
                $lulus = 0;
                foreach ($clean as $c) { if (($c['percent'] ?? 0) >= 75) $lulus++; }
                $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
                $summary = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent];
                session(['penilaian_wawancara_summary_bab_1' => $summary]);

                return response()->json(['success'=>true,'saved'=>$total,'summary'=>$summary,'students'=>$return]);
            } catch (\Throwable $e) {
                logger()->error('Wawancara save failed: ' . $e->getMessage(), ['exception' => $e]);
                return response()->json(['success'=>false,'message'=>'Server error saat menyimpan.','error'=>config('app.debug') ? $e->getMessage() : null], 500);
            }
        })->name('penilaian.wawancara.save');

        Route::post('/penilaian-kelas/wawancara/reset', function (Request $request) {
            try {
                session()->forget('penilaian_wawancara_bab_1');
                session()->forget('penilaian_wawancara_summary_bab_1');
                return response()->json(['success' => true]);
            } catch (\Throwable $e) {
                logger()->error('Wawancara reset failed: ' . $e->getMessage(), ['exception' => $e]);
                return response()->json(['success' => false, 'message' => 'Server error saat reset.'], 500);
            }
        })->name('penilaian.wawancara.reset');

        // Kotoba save/reset routes (per-bab)
        Route::post('/penilaian-kelas/kotoba/save', function (Request $request) {
            try {
                $bab = intval($request->input('bab', 1));
                $students = $request->input('students', []);

                if(!is_array($students) || count($students) === 0) {
                    return response()->json(['success' => false, 'message' => 'Tidak ada data siswa untuk disimpan.'], 422);
                }

                $map = [1 => 35, 2 => 59, 3 => 59, 4 => 59, 5 => 59, 6 => 59, 7 => 59];
                $questionsCount = $map[$bab] ?? 35;
                $clean = [];
                $return = [];
                
                foreach ($students as $s) {
                    $name = trim($s['name'] ?? '');
                    $correctRaw = isset($s['correct']) ? $s['correct'] : null;
                    $hasContent = $name !== '' || ($correctRaw !== null && $correctRaw !== '');
                    if (!$hasContent) continue; // skip truly empty rows
                    
                    $correct = intval($correctRaw ?? 0);
                    $correct = max(0, min($correct, $questionsCount));
                    $date = trim($s['date'] ?? '');
                    $rowIdx = isset($s['row']) ? intval($s['row']) : null;
                    $score = $questionsCount ? round(($correct / $questionsCount) * 100, 2) : 0;
                    
                    $clean[] = ['name' => $name, 'correct' => $correct, 'score' => $score, 'date' => $date];
                    $return[] = ['row' => $rowIdx, 'name' => $name, 'correct' => $correct, 'score' => $score, 'date' => $date];
                }

                session(['penilaian_kotoba_bab_' . $bab => $clean]);

                // summary
                $total = count($clean);
                $lulus = 0;
                foreach ($clean as $c) { 
                    if (($c['score'] ?? 0) >= 75) $lulus++; 
                }
                $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
                $summary = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent, 'questions' => $questionsCount, 'bab' => $bab];
                session(['penilaian_kotoba_summary_bab_' . $bab => $summary]);

                return response()->json(['success' => true, 'saved' => $total, 'summary' => $summary, 'students' => $return]);
            } catch (\Throwable $e) {
                logger()->error('Kotoba save failed: ' . $e->getMessage(), ['exception' => $e]);
                $resp = ['success' => false, 'message' => 'Server error saat menyimpan.'];
                if(config('app.debug')) { $resp['error'] = $e->getMessage(); }
                return response()->json($resp, 500);
            }
        })->name('penilaian.kotoba.save');

        Route::post('/penilaian-kelas/kotoba/reset', function (Request $request) {
            try {
                $bab = intval($request->input('bab', 1));
                session()->forget('penilaian_kotoba_bab_' . $bab);
                session()->forget('penilaian_kotoba_summary_bab_' . $bab);
                return response()->json(['success' => true]);
            } catch (\Throwable $e) {
                logger()->error('Kotoba reset failed: ' . $e->getMessage(), ['exception' => $e]);
                return response()->json(['success' => false, 'message' => 'Server error saat reset.'], 500);
            }
        })->name('penilaian.kotoba.reset');

        // Nilai Akhir save/reset routes
        Route::post('/penilaian-kelas/nilai-akhir/save', function (Request $request) {
            try {
                $students = $request->input('students', []);

                if(!is_array($students) || count($students) === 0) {
                    return response()->json(['success' => false, 'message' => 'Tidak ada data siswa untuk disimpan.'], 422);
                }

                $clean = [];
                $return = [];
                
                // Helper function to calculate grade
                $calculateGrade = function($nilai) {
                    $nilai = (int)$nilai;
                    if ($nilai >= 90) return 'A';
                    if ($nilai >= 85) return 'B+';
                    if ($nilai >= 80) return 'B';
                    if ($nilai >= 75) return 'C+';
                    if ($nilai >= 10) return 'C';
                    return 'TU';
                };
                
                foreach ($students as $s) {
                    $name = trim($s['name'] ?? '');
                    
                    // Collect all nilai subjects
                    $subjects = ['hiragana', 'katakana', 'bunpou', 'kerja', 'sifat', 'benda', 'terjemah', 'dengar', 'bicara'];
                    $nilaiValues = [];
                    $gradeValues = [];
                    $hasContent = $name !== '';
                    
                    foreach ($subjects as $subject) {
                        $value = intval($s[$subject] ?? 0);
                        $value = max(0, min($value, 100));
                        $nilaiValues[$subject] = $value;
                        // Calculate grade untuk setiap subject
                        $gradeValues["grade_$subject"] = $value === 0 ? '-' : $calculateGrade($value);
                        if ($value > 0) $hasContent = true;
                    }
                    
                    // Also include sikap and kehadiran
                    $sikap = trim($s['sikap'] ?? '');
                    $kehadiran = intval($s['kehadiran'] ?? 0);
                    if ($sikap || $kehadiran) $hasContent = true;
                    
                    if (!$hasContent) continue; // skip empty rows
                    
                    // Calculate rata-rata
                    $sum = array_sum($nilaiValues);
                    $count = count(array_filter($nilaiValues));
                    $rataRata = $count > 0 ? $sum / $count : 0;
                    
                    // Calculate grade akhir using formula
                    $grade = 'TU';
                    if ($rataRata >= 90) $grade = 'A';
                    elseif ($rataRata >= 85) $grade = 'B+';
                    elseif ($rataRata >= 80) $grade = 'B';
                    elseif ($rataRata >= 75) $grade = 'C+';
                    elseif ($rataRata >= 10) $grade = 'C';
                    
                    $rowData = array_merge(['name' => $name], $nilaiValues, $gradeValues, [
                        'sikap' => $sikap,
                        'kehadiran' => $kehadiran,
                        'rata_rata' => round($rataRata, 2),
                        'grade' => $grade
                    ]);
                    
                    $clean[] = $rowData;
                    $return[] = array_merge($rowData, ['row' => intval($s['row'] ?? 0)]);
                }

                session(['penilaian_nilai_akhir' => $clean]);

                // summary
                $total = count($clean);
                $lulus = 0;
                foreach ($clean as $c) { 
                    if (($c['rata_rata'] ?? 0) >= 75) $lulus++; 
                }
                $percent = $total ? round(($lulus / $total) * 100, 2) : 0;
                $summary = ['total' => $total, 'lulus' => $lulus, 'percent' => $percent];
                session(['penilaian_nilai_akhir_summary' => $summary]);

                return response()->json(['success' => true, 'saved' => $total, 'summary' => $summary, 'students' => $return]);
            } catch (\Throwable $e) {
                logger()->error('Nilai Akhir save failed: ' . $e->getMessage(), ['exception' => $e]);
                $resp = ['success' => false, 'message' => 'Server error saat menyimpan.'];
                if(config('app.debug')) { $resp['error'] = $e->getMessage(); }
                return response()->json($resp, 500);
            }
        })->name('penilaian.nilai-akhir.save');

        Route::post('/penilaian-kelas/nilai-akhir/reset', function (Request $request) {
            try {
                session()->forget('penilaian_nilai_akhir');
                session()->forget('penilaian_nilai_akhir_summary');
                return response()->json(['success' => true]);
            } catch (\Throwable $e) {
                logger()->error('Nilai Akhir reset failed: ' . $e->getMessage(), ['exception' => $e]);
                return response()->json(['success' => false, 'message' => 'Server error saat reset.'], 500);
            }
        })->name('penilaian.nilai-akhir.reset');

        Route::get('/penilaian-kelas/nilai-akhir', fn () => view('sensei.penilaian-nilai-akhir'))
            ->name('penilaian.nilai-akhir');
        Route::get('/penilaian-kelas/fmd', fn () => view('sensei.penilaian-fmd'))
            ->name('penilaian.fmd');
        Route::get('/status-siswa', fn () => view('sensei.statussiswa'))
            ->name('status-siswa');
    });
    
    Route::middleware(['auth'])
        ->prefix('sensei')
        ->name('sensei.')
        ->group(function () {
            Route::get('/evaluasi', [EvaluasiController::class, 'index'])
                ->name('evaluasi.index');
            Route::get('/evaluasi/siswa/{id}', [EvaluasiController::class, 'detailSiswaSeleksi'])
                ->name('evaluasi.detail.siswa');
            
            // Route for checking Kanji details
            Route::get('/evaluasi/siswa/{id}/kanji', fn () => view('sensei.evaluasi.detail.siswa.niali_kanji'))
                ->name('evaluasi.detail.siswa.kanji');
        });

// Minimal named login route redirects to the portal page
Route::get('/login', function () {
    return redirect()->route('login.portal');
})->name('login');

// Test route without auth/role middleware so developers can view the Sensei dashboard quickly.
// Visit: /sensei/test
Route::get('/sensei/test', [\App\Http\Controllers\Sensei\DashboardController::class, 'index'])
    ->name('sensei.test');

// Preview of Penilaian Kelas without auth for development (remove in production)
Route::get('/sensei/penilaian-kelas-preview', fn () => view('sensei.penilaian-kanji'))
    ->name('sensei.penilaian.preview');
Route::get('/sensei/penilaian-presensi-preview', fn () => view('sensei.penilaian-presensi'))
    ->name('sensei.penilaian.presensi.preview');
Route::get('/sensei/penilaian-bunpou-preview', fn () => view('sensei.penilaian-bunpou'))
    ->name('sensei.penilaian.bunpou.preview');
Route::get('/sensei/penilaian-kotoba-preview', fn () => view('sensei.penilaian-kotoba'))
    ->name('sensei.penilaian.kotoba.preview');
Route::get('/sensei/penilaian-wawancara-preview', fn () => view('sensei.penilaian-wawancara'))
    ->name('sensei.penilaian.wawancara.preview');
Route::get('/sensei/penilaian-nilai-akhir-preview', fn () => view('sensei.penilaian-nilai-akhir'))
    ->name('sensei.penilaian.nilai-akhir.preview');
Route::get('/sensei/penilaian-fmd-preview', fn () => view('sensei.penilaian-fmd'))
    ->name('sensei.penilaian.fmd.preview');
Route::get('/sensei/evaluasi-preview', fn () => view('sensei.evaluasi.index'))
    ->name('sensei.evaluasi.preview');
Route::get('/sensei/evaluasi/siswa-preview', fn () => view('sensei.evaluasi.detail.siswa.seleksi'))
    ->name('sensei.evaluasi.detail.preview');

    Route::get('/sensei/login', fn () => view('auth.sensei-login'))->name('sensei.login');
    Route::get('/sensei/register', fn () => view('auth.sensei-register'))->name('sensei.register');

    // Auth actions for sensei
    use App\Http\Controllers\Auth\SenseiAuthController;
    Route::post('/sensei/register', [SenseiAuthController::class, 'registerStore'])->name('sensei.register.store');
    Route::post('/sensei/login', [SenseiAuthController::class, 'loginPost'])->name('sensei.login.post');
    Route::post('/sensei/logout', [SenseiAuthController::class, 'logout'])->name('sensei.logout');

    // Siswa auth routes (same design as sensei)
    Route::get('/siswa/login', fn () => view('auth.siswa-login'))->name('siswa.login');
    Route::get('/siswa/register', fn () => view('auth.siswa-register'))->name('siswa.register');
    use App\Http\Controllers\Auth\SiswaAuthController;
    Route::post('/siswa/register', [SiswaAuthController::class, 'registerStore'])->name('siswa.register.store');
    Route::post('/siswa/login', [SiswaAuthController::class, 'loginPost'])->name('siswa.login.post');
    Route::post('/siswa/logout', [SiswaAuthController::class, 'logout'])->name('siswa.logout');
    // Karyawan auth routes (guru/karyawan choice)
    Route::get('/karyawan/login', fn () => view('auth.karyawan-login'))->name('karyawan.login');
    Route::get('/karyawan/register', fn () => view('auth.karyawan-register'))->name('karyawan.register');
    use App\Http\Controllers\Auth\KaryawanAuthController;
    Route::post('/karyawan/register', [KaryawanAuthController::class, 'registerStore'])->name('karyawan.register.store');
    Route::post('/karyawan/login', [KaryawanAuthController::class, 'loginPost'])->name('karyawan.login.post');
    Route::post('/karyawan/logout', [KaryawanAuthController::class, 'logout'])->name('karyawan.logout');

    // CRM auth routes (guru/karyawan choice)
    Route::get('/crm/login', fn () => view('auth.crm-login'))->name('crm.login');
    Route::get('/crm/register', fn () => view('auth.crm-register'))->name('crm.register');
    use App\Http\Controllers\Auth\CrmAuthController;
    Route::post('/crm/register', [CrmAuthController::class, 'registerStore'])->name('crm.register.store');
    Route::post('/crm/login', [CrmAuthController::class, 'loginPost'])->name('crm.login.post');
    Route::post('/crm/logout', [CrmAuthController::class, 'logout'])->name('crm.logout');

    // CRM protected routes
    use App\Http\Controllers\CRM\CRMController;
    Route::middleware(['auth:admin', 'role:CRM'])->prefix('crm')->name('crm.')->group(function () {
        Route::get('/dashboard', [CRMController::class, 'dashboard'])->name('dashboard');
        Route::get('/kesiswaan', [CRMController::class, 'kesiswaan'])->name('kesiswaan');
        Route::get('/pengajuan-siswa', [CRMController::class, 'pengajuansiswa'])->name('pengajuansiswa');
        Route::get('/data-kelas', [CRMController::class, 'datakelas'])->name('datakelas');
        Route::get('/testimoni-siswa', [CRMController::class, 'testimoni'])->name('testimoni');
        Route::get('/detail-kesiswaan/{id}', [CRMController::class, 'detailkesiswaan'])->name('detailkesiswaan');
        
        // Student Update API Routes
        Route::post('/students/{id}/update-status', [CRMController::class, 'updateStatus'])->name('students.update-status');
        Route::post('/students/{id}/update-followup', [CRMController::class, 'updateFollowUp'])->name('students.update-followup');
        Route::post('/students/{id}/update-batch', [CRMController::class, 'updateBatch'])->name('students.update-batch');
    });

    // Orang Tua auth routes (Siswa / Orang Tua choice)
    Route::get('/orangtua/login', fn () => view('auth.orangtua-login'))->name('orangtua.login');
    Route::get('/orangtua/register', fn () => view('auth.orangtua-register'))->name('orangtua.register');
    use App\Http\Controllers\Auth\OrangtuaAuthController;
    Route::post('/orangtua/register', [OrangtuaAuthController::class, 'registerStore'])->name('orangtua.register.store');
    Route::post('/orangtua/login', [OrangtuaAuthController::class, 'loginPost'])->name('orangtua.login.post');
    Route::post('/orangtua/logout', [OrangtuaAuthController::class, 'logout'])->name('orangtua.logout');

    // Admin auth routes (separate admin guard)
    use App\Http\Controllers\Admin\AuthController as AdminAuthController;
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::get('/admin/register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register.store');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Admin protected routes
    use App\Http\Controllers\Admin\StudentController;
    use App\Http\Controllers\Admin\KelasController;
    use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
    Route::middleware(['auth:admin', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::put('/profile', [AdminDashboardController::class, 'updateProfile'])->name('profile.update');
        
        // Kelas Management
        Route::resource('kelas', KelasController::class);
        Route::post('kelas/{kelas}/assign-student', [KelasController::class, 'assignStudent'])->name('kelas.assign_student');
        Route::get('/data-kelas', [StudentController::class, 'index'])->name('datakelas');
        Route::get('/siswa/create', [StudentController::class, 'create'])->name('siswa.create');
        Route::post('/siswa/store', [StudentController::class, 'store'])->name('siswa.store');
        Route::get('/pengajuan-siswa', [StudentController::class, 'submissions'])->name('pengajuansiswa');
        Route::post('/siswa/{id}/approve', [StudentController::class, 'approve'])->name('siswa.approve');
        Route::post('/siswa/{id}/assign-class', [StudentController::class, 'assignClass'])->name('siswa.assign_class');
        Route::get('/siswa/{id}/edit', [StudentController::class, 'edit'])->name('siswa.edit');
        Route::put('/siswa/{id}', [StudentController::class, 'update'])->name('siswa.update');
        Route::post('/siswa/{id}/remove-from-class', [StudentController::class, 'removeFromClass'])->name('siswa.remove_from_class');
        Route::delete('/siswa/{id}', [StudentController::class, 'destroy'])->name('siswa.destroy');
        Route::get('/detail-pemberkasan', fn () => view('admin.detailpemberkasan'))->name('detailpemberkasan');
        
        // Berkas Management
        Route::get('/berkas-pendaftaran', [\App\Http\Controllers\Admin\BerkasController::class, 'pendaftaran'])->name('berkaspendaftaran');
        Route::get('/berkas-seleksi', [\App\Http\Controllers\Admin\BerkasController::class, 'seleksi'])->name('berkasseleksi');
        Route::post('/berkas/{id}/approve', [\App\Http\Controllers\Admin\BerkasController::class, 'approve'])->name('berkas.approve');
        Route::post('/berkas/{id}/reject', [\App\Http\Controllers\Admin\BerkasController::class, 'reject'])->name('berkas.reject');
        Route::get('/berkas/download/{id}', [\App\Http\Controllers\Admin\BerkasController::class, 'download'])->name('berkas.download');
    });

    // Student protected routes
    Route::middleware(['auth', 'student.approved'])->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', fn () => view('siswa.dashboard'))->name('dashboard');
        Route::get('/waiting-approval', fn () => view('siswa.waiting_approval'))->name('waiting_approval');
        Route::get('/pembelajaran', fn () => view('siswa.pembelajaran'))->name('pembelajaran');
        Route::get('/nilai', fn () => view('siswa.nilai'))->name('nilai');
        Route::get('/jadwal-evaluasi', fn () => view('siswa.jadwal_evaluasi'))->name('jadwal_evaluasi');
        Route::get('/berkas', [\App\Http\Controllers\BerkasController::class, 'index'])->name('berkas');
        Route::post('/berkas/upload', [\App\Http\Controllers\BerkasController::class, 'store'])->name('berkas.store');
        Route::get('/berkas/download/{id}', [\App\Http\Controllers\BerkasController::class, 'download'])->name('berkas.download');
        Route::get('/informasi', fn () => view('siswa.informasi'))->name('informasi');
        Route::get('/pembayaran', fn () => view('siswa.pembayaran'))->name('pembayaran');
    });

    // Orang Tua protected routes
    Route::middleware(['auth'])->prefix('orangtua')->name('orangtua.')->group(function () {
        Route::get('/dashboard', fn () => view('orangtua.dashboard'))->name('dashboard');
        Route::get('/berkas', fn () => view('orangtua.pemberkasan'))->name('berkas');
        Route::get('/pembayaran', fn () => view('orangtua.pembayaran'))->name('pembayaran');
    });

    // Keuangan auth routes (guru/karyawan choice)
    Route::get('/keuangan/login', fn () => view('auth.keuangan-login'))->name('keuangan.login');
    Route::get('/keuangan/register', fn () => view('auth.keuangan-register'))->name('keuangan.register');
    use App\Http\Controllers\Auth\KeuanganAuthController;
    Route::post('/keuangan/register', [KeuanganAuthController::class, 'registerStore'])->name('keuangan.register.store');
    Route::post('/keuangan/login', [KeuanganAuthController::class, 'loginPost'])->name('keuangan.login.post');
    Route::post('/keuangan/logout', [KeuanganAuthController::class, 'logout'])->name('keuangan.logout');

    // Keuangan protected routes
    Route::middleware(['auth:admin', 'role:Keuangan'])->prefix('keuangan')->name('keuangan.')->group(function () {
        Route::get('/dashboard', fn () => view('keuangan.dashboard'))->name('dashboard');
        Route::get('/pembayaran', fn () => view('keuangan.pembayaran'))->name('pembayaran');
    });

    // 'role' middleware not registered yet; require auth only for now.
    Route::middleware(['auth'])
    ->get('/sensei/pengajaran', fn () => view('sensei.pengajaran'))
    ->name('sensei.pengajaran');
