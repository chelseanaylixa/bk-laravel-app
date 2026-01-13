<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Tampilkan form login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login standar dengan email dan password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah email sudah terdaftar
        $user = User::where('email', $credentials['email'])->first();

        // Jika email belum ada, buat user baru dengan status pending
        if (!$user) {
            // Buat user baru dengan password dan status pending
            $user = User::create([
                'name' => explode('@', $credentials['email'])[0], // Nama dari bagian email sebelum @
                'email' => $credentials['email'],
                'password' => bcrypt($credentials['password']),
                'role' => 'siswa', // Default role siswa, status pending menunggu persetujuan admin
                'status' => 'pending'
            ]);

            // Login user baru
            Auth::login($user);
            $request->session()->regenerate();

            // Redirect ke halaman waiting approval
            return redirect()->route('waiting-approval');
        }

        // Jika email sudah ada, cek password
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Jika role masih pending, redirect ke waiting approval
            if ($user->role === 'pending' || $user->status === 'pending') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda masih menunggu persetujuan admin. Harap tunggu maksimal 30 menit.',
                ])->onlyInput('email');
            }

            $role = $user->role;

            // Redirect berdasarkan role pengguna
            if (in_array($role, ['admin', 'guru_bk', 'siswa', 'wali_kelas', 'wali_murid'])) {
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak cocok.',
        ])->onlyInput('email');
    }
    public function showOtpForm()
    {
        // Pastikan pengguna sudah login dan belum terverifikasi
        if (Auth::check() && !Auth::user()->email_verified_at) {
            return view('auth.verify_otp');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Tampilkan halaman waiting approval untuk user pending.
     *
     * @return \Illuminate\View\View
     */
    public function showWaitingApproval()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if ($user->role !== 'pending' && $user->status !== 'pending') {
            return redirect()->route('dashboard');
        }

        return view('auth.waiting_approval');
    }
    /**
     * Logout pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Path redirect default setelah login (opsional).
     *
     * @return string
     */
    protected function redirectPath()
    {
        return route('dashboard');
    }
}
