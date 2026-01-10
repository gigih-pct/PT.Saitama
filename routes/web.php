<?php

use App\Http\Controllers\Sensei\PenilaianController;
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
    // Redirect users to the portal page after logout
    return redirect()->route('login.portal');
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
        Route::get('/penilaian-kelas', fn () => redirect()->route('sensei.penilaian.presensi'))
            ->name('penilaian');


        // Save/Reset presensi using Controller
        Route::post('/penilaian-kelas/presensi/save', [PenilaianController::class, 'savePresensi'])->name('penilaian.presensi.save');
        Route::post('/penilaian-kelas/presensi/reset', [PenilaianController::class, 'resetPresensi'])->name('penilaian.presensi.reset');


        // Support both /penilaian-kelas and /penilaian-kelas/kanji for Kanji page
        Route::controller(PenilaianController::class)->group(function() {
            Route::get('/penilaian-kelas/kanji', 'show')->defaults('type', 'kanji')->name('penilaian.kanji');
            Route::get('/penilaian-kelas/bunpou', 'show')->defaults('type', 'bunpou')->name('penilaian.bunpou');
            Route::get('/penilaian-kelas/kotoba', 'show')->defaults('type', 'kotoba')->name('penilaian.kotoba');
            Route::get('/penilaian-kelas/fmd', 'show')->defaults('type', 'fmd')->name('penilaian.fmd');
            Route::get('/penilaian-kelas/wawancara', 'show')->defaults('type', 'wawancara')->name('penilaian.wawancara');
            Route::get('/penilaian-kelas/presensi', 'show')->defaults('type', 'presensi')->name('penilaian.presensi');
            Route::get('/penilaian-kelas/nilai-akhir', 'show')->defaults('type', 'nilai-akhir')->name('penilaian.nilai-akhir');
        });

        // Kanji save/reset routes (per-bab)
        Route::post('/penilaian-kelas/kanji/save', [PenilaianController::class, 'saveKanji'])->name('penilaian.kanji.save');
        Route::post('/penilaian-kelas/kanji/reset', [PenilaianController::class, 'resetKanji'])->name('penilaian.kanji.reset');

        Route::post('/penilaian-kelas/bunpou/save', [PenilaianController::class, 'saveBunpou'])->name('penilaian.bunpou.save');
        Route::post('/penilaian-kelas/bunpou/reset', [PenilaianController::class, 'resetBunpou'])->name('penilaian.bunpou.reset');


        // Wawancara save/reset
        Route::post('/penilaian-kelas/wawancara/save', [PenilaianController::class, 'saveWawancara'])->name('penilaian.wawancara.save');
        Route::post('/penilaian-kelas/wawancara/reset', [PenilaianController::class, 'resetWawancara'])->name('penilaian.wawancara.reset');

        // Kotoba save/reset routes (per-bab)
        Route::post('/penilaian-kelas/kotoba/save', [PenilaianController::class, 'saveKotoba'])->name('penilaian.kotoba.save');
        Route::post('/penilaian-kelas/kotoba/reset', [PenilaianController::class, 'resetKotoba'])->name('penilaian.kotoba.reset');

        // FMD save/reset routes
        Route::post('/penilaian-kelas/fmd/save', [PenilaianController::class, 'saveFmd'])->name('penilaian.fmd.save');
        Route::post('/penilaian-kelas/fmd/reset', [PenilaianController::class, 'resetFmd'])->name('penilaian.fmd.reset');

        // Nilai Akhir save/reset routes
        Route::post('/penilaian-kelas/nilai-akhir/save', [PenilaianController::class, 'saveNilaiAkhir'])->name('penilaian.nilai-akhir.save');
        Route::post('/penilaian-kelas/nilai-akhir/reset', [PenilaianController::class, 'resetNilaiAkhir'])->name('penilaian.nilai-akhir.reset');


        Route::get('/status-siswa', [PenilaianController::class, 'statusSiswa'])
            ->name('status-siswa');
            
        // Student Update API Routes for Sensei
        Route::post('/students/{id}/update-status', [PenilaianController::class, 'updateStudentStatus'])->name('students.update-status');
        Route::post('/students/{id}/update-followup', [PenilaianController::class, 'updateStudentFollowUp'])->name('students.update-followup');
        Route::post('/students/{id}/update-batch', [PenilaianController::class, 'updateStudentBatch'])->name('students.update-batch');
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
            Route::get('/evaluasi/siswa/{id}/kanji', [EvaluasiController::class, 'detailSiswaKanji'])
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
Route::get('/sensei/penilaian-presensi-preview', fn () => view('sensei.penilaian-presensi', ['type' => 'presensi']))
    ->name('sensei.penilaian.presensi.preview');
Route::get('/sensei/penilaian-bunpou-preview', fn () => view('sensei.penilaian-bunpou', ['type' => 'bunpou']))
    ->name('sensei.penilaian.bunpou.preview');
Route::get('/sensei/penilaian-kotoba-preview', fn () => view('sensei.penilaian-kotoba', ['type' => 'kotoba']))
    ->name('sensei.penilaian.kotoba.preview');
Route::get('/sensei/penilaian-wawancara-preview', fn () => view('sensei.penilaian-wawancara', ['type' => 'wawancara']))
    ->name('sensei.penilaian.wawancara.preview');
Route::get('/sensei/penilaian-nilai-akhir-preview', fn () => view('sensei.penilaian-nilai-akhir', ['type' => 'nilai-akhir']))
    ->name('sensei.penilaian.nilai-akhir.preview');
Route::get('/sensei/penilaian-fmd-preview', fn () => view('sensei.penilaian-fmd', ['type' => 'fmd']))
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
