<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
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

            // Admin & Guru BK
            if (in_array($role, ['admin', 'guru_bk'])) {
                return redirect()->route('dashboard');
            }

            // Siswa, Wali, Guru Mapel, Kepala Sekolah
            if (in_array($role, ['siswa', 'wali_kelas', 'kepala_sekolah', 'wali_murid', 'guru_mapel'])) {
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak cocok.',
        ])->onlyInput('email');
    }

    // Login dengan Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

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
            return redirect()->route('login')
                ->with('error', 'Login Google gagal. Silakan coba lagi.');
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Redirect bawaan (opsional, kalau dipakai)
    protected function redirectPath()
    {
        return route('dashboard');
    }
}
