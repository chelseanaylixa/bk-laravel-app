<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\CurhatAIController;
use App\Models\Kasus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

// Route::get('/dashboard', [KasusController::class, 'index'])->name('kasus.index'); 
// NOTE: Route ini dihapus karena konflik dengan Route::resource('kasus') di bawah.

Route::resource('kasus', KasusController::class)->except(['index']); 
// NOTE: Saya menggunakan 'except' karena index diatur ulang di bawah

// Halaman utama
Route::get('/', fn() => view('welcome'));

// =============================
// Guest Routes (Belum Login)
// =============================
Route::middleware('guest')->group(function () {
    // Login & Register (sudah benar)
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Login dengan Google
    Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
});

// =============================
// Authenticated Routes (Sudah Login)
// =============================
Route::middleware('auth')->group(function () {
    // Profile (sudah benar)
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard sesuai role (Perbaikan minor: Menghilangkan $kasus->all() karena KasusController sudah mengurusnya)
    Route::get('dashboard', function () {
        $user = Auth::user();

        if (in_array($user->role, ['admin', 'guru_bk'])) {
            return redirect()->route('kasus.index'); // Langsung alihkan ke halaman utama kasus
        }

        if (in_array($user->role, ['wali_kelas', 'wali_murid', 'guru_mapel', 'kepala_sekolah', 'siswa'])) {
            return view('pages.dashboard-siswa');
        }

        abort(403, 'Akses tidak diizinkan.');
    })->name('dashboard');

    // =============================
    // Admin & Guru BK Routes (Perbaikan: Menambahkan KasusController@index di sini)
    // =============================
    Route::middleware('role:admin,guru_bk')->group(function () {
        Route::get('kasus', [KasusController::class, 'index'])->name('kasus.index'); // Route index (daftar kasus)
        Route::resource('kasus', KasusController::class)->only(['create', 'store', 'edit', 'update', 'destroy', 'show']);
    });
    // NOTE: Sekarang rute 'kasus.index' hanya bisa diakses oleh admin/guru_bk.

    // =============================
    // Routes untuk SEMUA role yang sudah login (Mengatasi Error 403)
    // =============================
    // Cukup gunakan Middleware 'auth' saja. Pembatasan logic (Admin vs Siswa) dilakukan di dalam View/Controller.
    Route::middleware('auth')
        ->group(function () {

            // Halaman dashboard siswa
            Route::get('pelanggaran', fn() => view('pages.pelanggaran'))->name('pelanggaran');
            Route::get('poin', fn() => view('pages.poin'))->name('poin');
            // Route kasus-page dihapus/diganti jika Anda menggunakan dashboard siswa sebagai halaman kasusnya.
            Route::get('jurusan', fn() => view('pages.jurusan'))->name('jurusan');
            Route::get('curhat-guru', fn() => view('pages.curhat-guru'))->name('curhat-guru');
            
            // Dua rute ini seharusnya hanya untuk Admin/Guru BK, jadi kita pindahkan
            // Route::get('kelola-users', fn() => view('pages.kelola-users'))->name('kelola.users');
            // Route::get('kelola-pelanggaran', fn() => view('pages.kelola-pelanggaran'))->name('kelola.pelanggaran');
            
            // Curhat AI
            Route::get('/curhat-ai', [CurhatAIController::class, 'index'])->name('curhat.ai');
            Route::post('/curhat-ai', [CurhatAIController::class, 'store'])->name('curhat.ai.store');
        });
        
    // =============================
    // Route Khusus Admin/Guru BK
    // =============================
    Route::middleware('role:admin,guru_bk')->group(function () {
        Route::get('kelola-users', fn() => view('pages.kelola-users'))->name('kelola.users');
        Route::get('kelola-pelanggaran', fn() => view('pages.kelola-pelanggaran'))->name('kelola.pelanggaran');
    });
});