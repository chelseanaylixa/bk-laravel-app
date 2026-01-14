<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'string', 'same:password'],
            'agree_terms' => ['required', 'accepted'],
            'g-recaptcha-response' => ['required'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'password_confirmation.same' => 'Konfirmasi kata sandi tidak cocok dengan kata sandi.',
            'password_confirmation.required' => 'Konfirmasi kata sandi wajib diisi.',
            'agree_terms.required' => 'Anda harus menyetujui kebijakan privasi dan syarat & ketentuan.',
            'agree_terms.accepted' => 'Anda harus menyetujui kebijakan privasi dan syarat & ketentuan.',
            'g-recaptcha-response.required' => 'Verifikasi reCAPTCHA gagal, silakan coba lagi.',
        ];
    }

    /**
     * Configure the validator instance (called after validation passes).
     */
    protected function passedValidation(): void
    {
        $this->verifyRecaptcha();
        $this->ensureIsNotRateLimited();
        $this->authenticate();
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function authenticate(): void
    {
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi tidak valid.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }

    /**
     * Verify reCAPTCHA response.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function verifyRecaptcha(): void
    {
        $recaptchaToken = $this->input('g-recaptcha-response');

        if (!$recaptchaToken) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal, silakan coba lagi.',
            ]);
        }

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => env('RECAPTCHA_SECRET_KEY'),
                    'response' => $recaptchaToken,
                ]
            ]);

            $body = json_decode((string)$response->getBody(), true);

            // Validasi jika score lebih rendah dari 0.5 (kemungkinan bot)
            if (!$body['success'] || $body['score'] < 0.5) {
                throw ValidationException::withMessages([
                    'g-recaptcha-response' => 'Verifikasi keamanan gagal, silakan coba lagi.',
                ]);
            }
        } catch (\Exception $e) {
            if ($e instanceof ValidationException) {
                throw $e;
            }
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Terjadi kesalahan saat verifikasi keamanan.',
            ]);
        }
    }
}
