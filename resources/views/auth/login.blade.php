<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        :root {
            --primary-color: #0f2862;
            --secondary-color: #9e363a;
            --accent-color: #4f5f76;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            background-image: linear-gradient(135deg, rgba(0, 0, 0, 0.95) 0%, rgba(199, 199, 199, 0.95) 100%),
            url("{{ asset('images/backgroundlogin.png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            background-color: transparent;
            border-radius: 0;
            box-shadow: none;
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }

        .login-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 25px;
            text-align: center;
            border-radius: 0;
        }

        .login-header h2 {
            font-weight: bold;
        }

        .login-header p {
            font-size: 14px;
            margin: 0;
        }

        .login-body {
            padding: 25px;
            background-color: white;
            border-radius: 0;
        }

        .login-body h4 {
            font-weight: 600;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(15, 40, 98, 0.25);
        }

        .input-group-text {
            background: var(--light-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-google {
            background-color: #fff;
            color: #757575;
            border: 1px solid #ddd;
            transition: 0.3s;
        }

        .btn-google:hover {
            background-color: #f5f5f5;
            border-color: #ccc;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider span {
            padding: 0 10px;
            color: #777;
            font-size: 14px;
        }

        /* CSS yang terkait toggle password bisa dihapus karena sudah diatasi Bootstrap, 
           tapi saya biarkan jika Anda ingin menambahkan styling tambahan pada ikon */
        .password-toggle {
            cursor: pointer;
            color: #6c757d;
            transition: color 0.3s;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        /* Styling untuk validation feedback */
        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-valid {
            border-color: #198754;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
            padding-right: calc(1.5em + 0.75rem);
        }

        .g-recaptcha {
            margin: 15px 0;
            display: flex;
            justify-content: center;
        }

        .form-check-label a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Bagian CSS lainnya */
        .otp-container {
            display: none;
        }

        .login-footer {
            text-align: center;
            padding: 15px;
            background-color: var(--light-color);
            font-size: 0.9rem;
            color: #6c757d;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-graduation-cap me-2"></i>Sistem Sekolah</h2>
            <p class="mb-0">Masuk ke akun Anda</p>
        </div>
        <div class="login-body">
            <div id="loginForm">
                <div class="mb-4 text-center">
                    <h4>Selamat Datang</h4>
                    <p class="text-muted">Silakan masuk dengan akun Anda</p>
                </div>

                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif  
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Input Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                    </div>

                    {{-- **Input Kata Sandi (Diperbaiki)** --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <div class="input-group">
                            <input id="password" type="password" name="password" class="form-control" autocomplete="current-password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" title="Tampilkan/Sembunyikan Kata Sandi">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    {{-- **Input Konfirmasi Kata Sandi** --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                        <div class="input-group">
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" autocomplete="current-password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm" title="Tampilkan/Sembunyikan Kata Sandi">
                                <i class="fas fa-eye" id="toggleIconConfirm"></i>
                            </button>
                        </div>
                        <small class="text-muted d-block mt-1">Kata sandi harus sama</small>
                    </div>

                    {{-- **reCAPTCHA v3** --}}
                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-action="LOGIN"></div>
                        @error('g-recaptcha-response')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- **Checkbox Persetujuan** --}}
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="agreeTerms" name="agree_terms" required>
                        <label class="form-check-label" for="agreeTerms">
                            Saya menyetujui <a href="#" target="_blank">Kebijakan Privasi</a> dan <a href="#" target="_blank">Syarat & Ketentuan</a>
                        </label>
                    </div>

                    {{-- Tombol Login --}}
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary" id="submitBtn">Login</button>
                    </div>
                </form>
                <div class="login-footer">
                    &copy; 2025 Sistem Sekolah. All rights reserved.
                </div>
            </div>

            <script>
                // Memastikan kode dieksekusi setelah semua elemen HTML dimuat
                document.addEventListener('DOMContentLoaded', function() {
                    const passwordInput = document.getElementById('password');
                    const toggleButton = document.getElementById('togglePassword');
                    const toggleIcon = document.getElementById('toggleIcon');

                    const passwordConfirmInput = document.getElementById('password_confirmation');
                    const toggleButtonConfirm = document.getElementById('togglePasswordConfirm');
                    const toggleIconConfirm = document.getElementById('toggleIconConfirm');

                    const submitBtn = document.getElementById('submitBtn');
                    const agreeTerms = document.getElementById('agreeTerms');

                    if (passwordInput && toggleButton && toggleIcon) {
                        toggleButton.addEventListener('click', function() {
                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                toggleIcon.classList.remove('fa-eye');
                                toggleIcon.classList.add('fa-eye-slash');
                            } else {
                                passwordInput.type = 'password';
                                toggleIcon.classList.remove('fa-eye-slash');
                                toggleIcon.classList.add('fa-eye');
                            }
                        });
                    }

                    if (passwordConfirmInput && toggleButtonConfirm && toggleIconConfirm) {
                        toggleButtonConfirm.addEventListener('click', function() {
                            if (passwordConfirmInput.type === 'password') {
                                passwordConfirmInput.type = 'text';
                                toggleIconConfirm.classList.remove('fa-eye');
                                toggleIconConfirm.classList.add('fa-eye-slash');
                            } else {
                                passwordConfirmInput.type = 'password';
                                toggleIconConfirm.classList.remove('fa-eye-slash');
                                toggleIconConfirm.classList.add('fa-eye');
                            }
                        });
                    }

                    // Validasi konfirmasi password
                    if (passwordInput && passwordConfirmInput) {
                        passwordConfirmInput.addEventListener('change', function() {
                            if (passwordInput.value !== passwordConfirmInput.value) {
                                passwordConfirmInput.classList.add('is-invalid');
                                passwordConfirmInput.classList.remove('is-valid');
                            } else {
                                passwordConfirmInput.classList.remove('is-invalid');
                                passwordConfirmInput.classList.add('is-valid');
                            }
                        });
                    }

                    // Disable tombol jika checkbox tidak dicentang
                    if (submitBtn && agreeTerms) {
                        agreeTerms.addEventListener('change', function() {
                            submitBtn.disabled = !this.checked;
                        });
                        submitBtn.disabled = !agreeTerms.checked;
                    }
                });
            </script>
            <script>
                window.onload = function() {
                    if (window.history && window.history.pushState) {
                        // Menjaga agar tombol 'back' tidak kembali ke halaman sebelumnya
                        window.history.pushState('forward', document.title, window.location.pathname);

                        // Mencegah kembali ke riwayat sebelum login
                        window.addEventListener('popstate', function(e) {
                            window.location.replace("{{ url('/') }}"); // Ganti ke landing page
                        });
                    }
                }
            </script>
</body>

</html>