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

    /**
     * Redirect pengguna ke halaman otentikasi Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Tangani callback dari Google setelah otentikasi.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $socialiteUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['email' => $socialiteUser->getEmail()],
                [
                    'name' => $socialiteUser->getName(),
                    'password' => bcrypt(uniqid()), // password random
                    'role' => 'siswa' // default role untuk login Google
                ]
            );

            Auth::login($user, true);

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            // Log the error if necessary
            // \Log::error('Google login failed: ' . $e->getMessage()); 

            return redirect()->route('login')
                ->with('error', 'Login Google gagal. Silakan coba lagi.');
        }
    }

    /**
     * Tampilkan form untuk input kode OTP (Asumsi: ada view 'auth.verify_otp').
     *
     * @return \Illuminate\View\View
     */
    public function showOtpForm()
    {
        // Pastikan pengguna sudah login dan belum terverifikasi
        if (Auth::check() && !Auth::user()->email_verified_at) {
            return view('auth.verify_otp');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Proses verifikasi kode OTP.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyOtp(Request $request)
    {
        // Memastikan pengguna terautentikasi untuk verifikasi
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'otp' => ['required', 'string', 'digits:6'], // Asumsi OTP 6 digit
        ]);

        $user = Auth::user();

        // Cek apakah OTP yang dimasukkan benar
        if ($request->otp === $user->otp) {
            // Verifikasi berhasil
            $user->email_verified_at = now();
            $user->otp = null; // Hapus kode OTP
            $user->save();

            // Beri notifikasi sukses dan arahkan ke dashboard siswa
            return redirect()->route('siswa.dashboard')->with('status', 'Akun berhasil diverifikasi!');
        }

        // OTP tidak cocok
        return back()->withErrors([
            'otp' => 'Kode verifikasi tidak valid.',
        ])->onlyInput('otp');
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