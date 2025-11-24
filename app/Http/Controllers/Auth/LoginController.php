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

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role = $user->role;

            // Redirect berdasarkan role pengguna
            if (in_array($role, ['admin', 'guru_bk', 'siswa', 'wali_kelas', 'kepala_sekolah', 'wali_murid', 'guru_mapel'])) {
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