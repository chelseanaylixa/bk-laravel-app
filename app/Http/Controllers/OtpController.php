<?php

// app/Http/Controllers/OtpController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function showVerifyForm(Request $request)
    {
        $email = $request->query('email');
        if (!$email) {
            return redirect()->route('login');
        }
        return view('auth.verify-otp', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp !== $request->otp || now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kedaluwarsa.']);
        }

        // OTP valid, login user
        Auth::login($user);
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->intended('/dashboard');
    }
}
