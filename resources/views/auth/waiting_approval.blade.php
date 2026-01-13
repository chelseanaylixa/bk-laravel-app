<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Persetujuan Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #003366 0%, #004aad 50%, #0066cc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 500px;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 51, 102, 0.3);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(to right, #003366, #004aad);
            color: white;
            padding: 40px 20px;
            text-align: center;
            border-radius: 20px 20px 0 0;
        }

        .card-header h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 0;
        }

        .card-body {
            padding: 40px 30px;
            text-align: center;
            background-color: #f8fbff;
        }

        .loading-spinner {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            position: relative;
        }

        .spinner {
            border: 8px solid #e0e8f2;
            border-top: 8px solid #004aad;
            border-radius: 50%;
            width: 100%;
            height: 100%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .status-text {
            font-size: 18px;
            color: #003366;
            margin-bottom: 20px;
            line-height: 1.6;
            font-weight: 500;
        }

        .email-display {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 5px solid #004aad;
        }

        .email-label {
            font-size: 12px;
            color: #0066cc;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .email-value {
            font-size: 18px;
            font-weight: bold;
            color: #003366;
        }

        .timer {
            font-size: 48px;
            font-weight: bold;
            color: #004aad;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
        }

        .timer-label {
            font-size: 12px;
            color: #0066cc;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .info-box {
            background-color: #e3f2fd;
            border-left: 5px solid #004aad;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            color: #003366;
        }

        .info-icon {
            margin-right: 10px;
            color: #004aad;
        }

        .logout-btn {
            margin-top: 20px;
            background-color: #0066cc;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background-color: #004aad;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 74, 173, 0.3);
        }

        .pulses {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-hourglass-half me-2"></i> Menunggu Persetujuan</h2>
                <p class="mb-0">Admin sedang memproses akun Anda</p>
            </div>
            <div class="card-body">
                <div class="loading-spinner">
                    <div class="spinner"></div>
                </div>

                <div class="status-text pulses">
                    <p><i class="fas fa-info-circle me-2"></i></p>
                    <strong>Akun Anda telah terdaftar!</strong>
                    <p>Admin akan meninjau dan menetapkan role untuk akun Anda dalam waktu singkat.</p>
                </div>

                <div class="email-display">
                    <div class="email-label"><i class="fas fa-envelope me-2"></i>Email Anda</div>
                    <div class="email-value">{{ Auth::user()->email }}</div>
                </div>

                <div class="info-box">
                    <i class="fas fa-clock info-icon"></i>
                    <strong>Estimasi Waktu Persetujuan:</strong> Maksimal 30 menit
                </div>

                <div class="timer-label">Waktu Tunggu</div>
                <div class="timer">⏱️ 00:30:00</div>

                <div class="info-box" style="background-color: #e3f2fd; border-left-color: #004aad; color: #003366;">
                    <i class="fas fa-lightbulb info-icon"></i>
                    <small>
                        <strong>💡 Tips:</strong> Harap tunggu di halaman ini. Halaman akan otomatis refresh setiap 10 detik untuk mengecek status persetujuan.
                        Anda akan diarahkan ke dashboard setelah admin menetapkan role.
                    </small>
                </div>

                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Timer untuk menampilkan waktu tunggu
        let secondsLeft = 1800; // 30 menit dalam detik

        function updateTimer() {
            const hours = Math.floor(secondsLeft / 3600);
            const minutes = Math.floor((secondsLeft % 3600) / 60);
            const seconds = secondsLeft % 60;

            const timeDisplay = String(hours).padStart(2, '0') + ':' +
                String(minutes).padStart(2, '0') + ':' +
                String(seconds).padStart(2, '0');

            document.querySelector('.timer').textContent = '⏱️ ' + timeDisplay;

            if (secondsLeft > 0) {
                secondsLeft--;
            }
        }

        // Update timer setiap detik
        setInterval(updateTimer, 1000);

        // Check status setiap 10 detik
        setInterval(async function() {
            try {
                const response = await fetch('/api/user-status', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log('📊 Status check:', data);

                    // Jika role sudah di-assign (bukan pending), redirect ke dashboard
                    if (data.role && data.role !== 'pending' && data.status !== 'pending') {
                        console.log('✅ Role approved! Redirecting to dashboard...');
                        // Redirect ke dashboard
                        setTimeout(function() {
                            window.location.href = '{{ route("dashboard") }}';
                        }, 1000);
                    }
                }
            } catch (error) {
                console.error('Error checking status:', error);
            }
        }, 10000); // Setiap 10 detik

        // Update timer pada saat load
        updateTimer();
    </script>
</body>

</html>