<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3b5998;
            --secondary-color: #4c70ba;
            --accent-color: #ff6b6b;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
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
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }
        .login-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 25px;
            text-align: center;
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
        }
        .login-body h4 {
            font-weight: 600;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(59, 89, 152, 0.25);
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
        /* Bagian CSS lainnya */
        .otp-container {
            display: none;
        }
        .progress {
            height: 8px;
            border-radius: 50px;
        }
        #otpTimer {
            transition: width 1s linear;
        }
        .login-footer {
            text-align: center;
            padding: 15px;
            background-color: var(--light-color);
            font-size: 0.9rem;
            color: #6c757d;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
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

                    {{-- Tombol Login --}}
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
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

            if (passwordInput && toggleButton && toggleIcon) {
                // Menambahkan event listener ke tombol saat diklik
                toggleButton.addEventListener('click', function() {
                    // Logika untuk menampilkan/menyembunyikan kata sandi
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        toggleIcon.classList.remove('fa-eye'); // Hapus ikon mata terbuka
                        toggleIcon.classList.add('fa-eye-slash'); // Tambah ikon mata tertutup
                    } else {
                        passwordInput.type = 'password';
                        toggleIcon.classList.remove('fa-eye-slash'); // Hapus ikon mata tertutup
                        toggleIcon.classList.add('fa-eye'); // Tambah ikon mata terbuka
                    }
                });
            }
        });
    </script>
</body>
</html>