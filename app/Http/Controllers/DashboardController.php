<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kasus;
use App\Models\TataTertib;
use App\Models\Pelanggaran; // Digunakan untuk daftar jenis pelanggaran
use App\Models\User;       // Digunakan untuk mengambil daftar siswa/users

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard sesuai peran pengguna (Routing utama).
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
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
            // Mengambil semua kasus dengan relasi siswa dan guru
            $kasus = Kasus::with(['siswa', 'guru'])->get();
            // Asumsi view 'kasus.index' adalah dashboard utama untuk BK/Admin
            return view('kasus.index', compact('user', 'kasus')); 
        }

        // Wali kelas / Siswa / Wali murid / Kepala sekolah / Guru mapel → dashboard siswa
        if (in_array($role, ['wali_kelas', 'siswa', 'wali_murid', 'kepala_sekolah', 'guru_mapel'])) {
            // Asumsi view 'pages.dashboard-siswa' adalah dashboard utama untuk siswa/wali
            return view('pages.dashboard-siswa', compact('user'));
        }

        // Jika role tidak dikenali → logout
        Auth::logout();
        return redirect()->route('login')->with('error', 'Role pengguna tidak dikenali.');
    }

    // -----------------------------------------------------
    // FITUR: TATA TERTIB (Untuk Siswa/Publik - Menampilkan daftar peraturan)
    // -----------------------------------------------------

    /**
     * Menampilkan daftar tata tertib/pelanggaran (digunakan untuk siswa/wali).
     *
     * @return \Illuminate\View\View
     */
    public function pelanggaran()
    {
        // Mengambil semua data Tata Tertib dari database
        $tataTertibs = TataTertib::all();
        
        // Asumsi view untuk menampilkan daftar tata tertib adalah 'siswa.pelanggaran'
        return view('siswa.pelanggaran', compact('tataTertibs'));
    }

    // -----------------------------------------------------
    // FITUR: INPUT PELANGGARAN (Untuk Admin/Guru BK - Menginput kasus baru)
    // -----------------------------------------------------

    /**
     * Menampilkan form untuk input pelanggaran baru.
     * * @return \Illuminate\View\View
     */
    public function createPelanggaran()
    {
        // 1. Ambil data siswa (asumsi role siswa)
        $siswas = User::where('role', 'siswa')->orderBy('name', 'asc')->get(); 

        // 2. Ambil daftar jenis pelanggaran dari model Pelanggaran (digunakan untuk dropdown/pilihan)
        $jenisPelanggaran = Pelanggaran::all();

        // Asumsi view untuk input adalah 'admin.pelanggaran.create'
        return view('admin.pelanggaran.create', compact('siswas', 'jenisPelanggaran'));
    }

    /**
     * Menyimpan data pelanggaran baru ke database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePelanggaran(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'pelanggaran_id' => 'required|exists:pelanggaran,id',
            'catatan' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        // 2. Dapatkan poin dari jenis pelanggaran yang dipilih
        $pelanggaran = Pelanggaran::find($request->pelanggaran_id);
        
        if (!$pelanggaran) {
            return back()->with('error', 'Jenis pelanggaran tidak ditemukan.');
        }

        // 3. Simpan data kasus baru ke tabel 'kasus'
        Kasus::create([
            'siswa_id' => $request->siswa_id,
            'pelanggaran_id' => $request->pelanggaran_id,
            'poin' => $pelanggaran->jumlah_poin ?? 0, // Pastikan kolom jumlah_poin ada di model Pelanggaran
            'catatan' => $request->catatan,
            'guru_id' => Auth::id(), // ID Guru/Admin yang mencatat
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('kasus.index')->with('success', 'Data pelanggaran berhasil dicatat.');
    }
}