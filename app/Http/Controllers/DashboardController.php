<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kasus;
use App\Models\ArsipKelulusan;
use App\Models\PerkembanganSiswa;

class DashboardController extends Controller
{
    /**
     * Dashboard khusus siswa (menampilkan kasus, perkembangan, arsip).
     */
    public function siswaDashboard()
    {
        $kasus = Kasus::latest()->get();
        $perkembangan = PerkembanganSiswa::latest()->get();
        $arsip = ArsipKelulusan::latest()->get();

        return view('dashboard-siswa', compact('kasus', 'perkembangan', 'arsip'));
    }

    /**
     * Dashboard default (untuk admin & guru BK).
     */
    public function index()
    {
        $arsipKelulusan = [];
        $user = Auth::user();

        if ($user && in_array($user->role, ['admin', 'guru_bk'])) {
            $arsipKelulusan = ArsipKelulusan::all();
        }

        return view('dashboard', compact('arsipKelulusan'));
    }

    /**
     * Menampilkan dashboard sesuai peran pengguna.
     */
    public function showDashboard()
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $role = $user->role;

        // Admin / Guru BK → arahkan ke halaman kasus
        if (in_array($role, ['admin', 'guru_bk'])) {
            $kasus = Kasus::with(['siswa', 'guru'])->get();
            return view('kasus.index', compact('user', 'kasus'));
        }

        // Wali kelas / Siswa / Wali murid / Kepala sekolah / Guru mapel → dashboard siswa
        if (in_array($role, ['wali_kelas', 'siswa', 'wali_murid', 'kepala_sekolah', 'guru_mapel'])) {
            return view('pages.dashboard-siswa', compact('user'));
        }

        // Jika role tidak dikenali → logout
        Auth::logout();
        return redirect()->route('login')->with('error', 'Role pengguna tidak dikenali.');
    }
}
