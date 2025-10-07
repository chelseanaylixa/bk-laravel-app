<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerkembanganSiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\CurhatAIController;
use App\Http\Controllers\ArsipKelulusanController;
use App\Http\Controllers\Admin\ArsipKelulusanController as AdminArsipKelulusanController;
use App\Models\Kasus;

Route::resource('kasus', KasusController::class);
Route::resource('arsip', ArsipKelulusanController::class);
Route::resource('perkembangan', PerkembanganSiswaController::class);


Route::get('/dashboard-siswa', [DashboardController::class, 'siswaDashboard'])
    ->name('dashboard.siswa');


// Halaman utama
Route::get('/', fn () => view('welcome'));

// =============================
// Guest Routes (Belum Login)
// =============================
Route::middleware('guest')->group(function () {
    // Login & Register
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // OTP Verification
    Route::get('verify-otp', [OtpController::class, 'showVerifyForm'])->name('otp.verify.form');
    Route::post('verify-otp', [OtpController::class, 'verify'])->name('otp.verify');

    // Login dengan Google
    Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
});

// =============================
// Authenticated Routes (Sudah Login)
// =============================
Route::middleware('auth')->group(function () {
    // Profile
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard sesuai role
    Route::get('dashboard', function () {
        $user = Auth::user();

        if (in_array($user->role, ['admin', 'guru_bk'])) {
            $kasus = Kasus::all();
            return view('kasus.index', compact('kasus'));
        }

        if (in_array($user->role, ['wali_kelas', 'wali_murid', 'guru_mapel', 'kepala_sekolah', 'siswa'])) {
            return view('pages.dashboard-siswa');
        }

        abort(403, 'Akses tidak diizinkan.');
    })->name('dashboard');

    // =============================
    // Admin & Guru BK Routes
    // =============================
    Route::middleware('role:admin,guru_bk')->group(function () {
        Route::resource('kasus', KasusController::class);

        // Manajemen Arsip Kelulusan
        Route::prefix('admin')->group(function () {
            Route::get('/arsip-lulusan', [AdminArsipKelulusanController::class, 'index'])->name('admin.arsip.index');
            Route::get('/arsip-lulusan/create', [AdminArsipKelulusanController::class, 'create'])->name('admin.arsip.create');
            Route::post('/arsip-lulusan', [AdminArsipKelulusanController::class, 'store'])->name('admin.arsip.store');
            Route::get('/arsip-lulusan/{id}/edit', [AdminArsipKelulusanController::class, 'edit'])->name('admin.arsip.edit');
            Route::put('/arsip-lulusan/{id}', [AdminArsipKelulusanController::class, 'update'])->name('admin.arsip.update');
            Route::delete('/arsip-lulusan/{id}', [AdminArsipKelulusanController::class, 'destroy'])->name('admin.arsip.destroy');
        });
    });

    // =============================
    // Routes untuk semua role siswa & guru
    // =============================
    Route::middleware('role:admin,guru_bk,wali_kelas,kepala_sekolah,wali_murid,guru_mapel,siswa')
        ->group(function () {
            // Resource
            Route::resource('perkembangan', PerkembanganSiswaController::class);

            // Halaman dashboard siswa
            Route::get('pelanggaran', fn() => view('pages.pelanggaran'))->name('pelanggaran');
            Route::get('poin', fn() => view('pages.poin'))->name('poin');
            Route::get('kasus-page', fn() => view('pages.kasus'))->name('kasus.page');
            Route::get('jurusan', fn() => view('pages.jurusan'))->name('jurusan');
            Route::get('curhat-guru', fn() => view('pages.curhat-guru'))->name('curhat-guru');
            Route::get('kelola-users', fn() => view('pages.kelola-users'))->name('kelola.users');
            Route::get('kelola-pelanggaran', fn() => view('pages.kelola-pelanggaran'))->name('kelola.pelanggaran');
            Route::get('lihat-laporan', fn() => view('pages.lihat-laporan'))->name('lihat.laporan');
            Route::get('kotak-masuk-curhatan', fn() => view('pages.kotak-masuk-curhatan'))->name('chat.siswa');

            // Curhat AI
            Route::get('/curhat-ai', [CurhatAIController::class, 'index'])->name('curhat.ai');
            Route::post('/curhat-ai', [CurhatAIController::class, 'store'])->name('curhat.ai.store');

            // Arsip Kelulusan (siswa hanya lihat)
            Route::get('/arsip-lulusan', [ArsipKelulusanController::class, 'index'])->name('arsip.lulusan');
        });
});
