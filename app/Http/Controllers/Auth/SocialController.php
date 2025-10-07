<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            /** @var \Laravel\Socialite\Two\User $googleUser */
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google.');
        }

        if (!$googleUser || !$googleUser->getEmail()) {
            return redirect('/login')->with('error', 'Data Google tidak ditemukan.');
        }

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName() ?? 'User',
                'password' => Hash::make(Str::random(16)),
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
