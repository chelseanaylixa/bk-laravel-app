<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $role = $request->input('role');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === $role) {
                $request->session()->regenerate();

                // Logika pengalihan berdasarkan peran
                switch ($user->role) {
                    case 'admin':
                        return redirect()->intended(route('admin.dashboard'));
                    
                    case 'guru_bk':
                        return redirect()->intended(route('gurubk.dashboard'));

                    // Peran lain diarahkan ke dashboard siswa
                    case 'siswa':
                    case 'wali_murid':
                    case 'guru_mapel':
                    case 'wali_kelas':
                    case 'kepala_sekolah':
                        return redirect()->intended(route('siswa.dashboard'));
                    
                    default:
                        // Pengalihan default jika ada peran yang tidak terdaftar di atas
                        return redirect()->intended(route('dashboard'));
                }
            } else {
                Auth::logout();
                return back()->withErrors([
                    'role' => 'Peran yang Anda pilih tidak cocok dengan akun ini.',
                ])->onlyInput('email');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi tidak valid.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}