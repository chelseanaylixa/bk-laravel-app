<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - SMK Antartika 1 Sidoarjo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        /* Reset dan style dasar */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e6f0ff 0%, #c9e2ff 100%);
            color: #0d1a40;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: linear-gradient(to right, #0f2862, #4f5f76, #9e363a);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .school-info {
            display: flex;
            align-items: center;
        }

        .school-info h2 {
            color: white;
        }

        .school-logo {
            width: 60px;
            height: 60px;
            background: transparent;
            border-radius: 0;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #0f2862;
        }

        /* Modifikasi user-info untuk dropdown */
        .user-info {
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info:hover .user-details {
            text-decoration: underline;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0f2862;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        /* Dropdown Logout */
        .dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 10px 0;
            min-width: 150px;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s ease;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu a {
            color: #0f2862;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f0f5ff;
        }

        /* Container utama */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0, 0, 80, 0.15);
            padding: 30px 40px;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(to right, #0f2862, #4f5f76, #9e363a);
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: 700;
            color: #0f2862;
            position: relative;
            padding-bottom: 15px;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, #0f2862, #4f5f76, #9e363a);
            border-radius: 2px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        h1 {
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        h2 {
            color: #0f2862;
            font-size: 24px;
            margin-top: 40px;
            margin-bottom: 20px;
            padding-left: 10px;

        }

        h3 {
            color: #0f2862;
            font-size: 20px;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        /* Description Box */
        .description-box {
            background: linear-gradient(135deg, #f0f7ff 0%, #e6f4ff 100%);
            padding: 30px;
            border-radius: 14px;
            margin-bottom: 80px;
            border-left: 6px solid #0f2862;
            border-right: 6px solid #0f2862;
            box-shadow: 0 8px 20px rgba(0, 52, 102, 0.12);
            animation: fadeInUp 0.8s ease-out 0.2s both;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .description-box::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(0, 74, 173, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .description-box:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 30px rgba(0, 52, 102, 0.18);
            border-left-color: #0f2862;
            border-right-color: #0f2862;
        }

        .description-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0f2862, #0f2862);
            color: white;
            border-radius: 50%;
            font-size: 24px;
            margin-bottom: 15px;
            box-shadow: 0 4px 12px rgba(0, 52, 102, 0.25);
        }

        .description-box p {
            color: #1a3a52;
            font-size: 15px;
            line-height: 2;
            text-align: justify;
            position: relative;
            z-index: 1;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .description-box:hover p {
            transform: scale(1.02);
            transform-origin: left center;
        }

        .description-box strong {
            color: #0f2862;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .description-box:hover strong {
            color: #0f2862;
            text-shadow: 0 2px 8px rgba(0, 74, 173, 0.2);
        }

        /* Menu pilihan */
        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
            animation: slideInFromLeft 0.8s ease-out 0.4s both;
            perspective: 1000px;
        }

        .menu-item {
            background: linear-gradient(to bottom, #0f2862, #0f2862);
            color: white;
            padding: 30px 20px;
            border-radius: 12px;
            text-align: center;
            font-weight: 600;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 6px 15px rgba(0, 74, 173, 0.4);
            transition: all 0.6s ease;
            user-select: none;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: visible;
            min-height: 140px;
            transform-style: preserve-3d;
        }

        .menu-item-front,
        .menu-item-back {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            backface-visibility: hidden;
            padding: 30px 20px;
            border-radius: 12px;
        }

        .menu-item-front {
            transform: rotateY(0deg);
            background: linear-gradient(to bottom, #0f2862, #0f2862);
        }

        .menu-item-back {
            transform: rotateY(180deg);
            font-size: 14px;
            line-height: 1.5;
            background: linear-gradient(to bottom, #0f2862, #001f4d);
        }

        .menu-item:hover {
            transform: rotateY(180deg) translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 74, 173, 0.5);
        }

        .menu-item i {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .menu-item span {
            font-weight: 600;
        }

        .menu-item-desc {
            font-size: 12px;
            opacity: 0.95;
            font-weight: 500;
        }

        /* Table Styling */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #f9fbfd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .data-table th,
        .data-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e7ee;
        }

        .data-table thead {
            background-color: #0f2862;
            color: white;
        }

        .data-table tbody tr:hover {
            background-color: #e6f0ff;
        }

        .data-table .action-buttons button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .data-table .action-buttons button:hover {
            background-color: #0056b3;
        }

        .student-info-card {
            background: #f0f5ff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: inset 0 0 10px #cce0ff;
            color: #0f2862;
            margin-top: 30px;
        }

        .student-info-card p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .student-info-card strong {
            color: #0f2862;
        }


        /* Profil Sosial Media Sekolah */
        .social-section {
            margin-bottom: 40px;
        }

        .social-section h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #0f2862;
            font-weight: 600;
        }

        .social-profiles {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .social-profiles a {
            text-decoration: none;
            color: white;
            font-size: 28px;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .social-profiles a::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(255, 255, 255, 0.2), transparent);
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .social-profiles a:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
        }

        .social-profiles a:hover::before {
            transform: translateY(0);
        }

        .social-profiles a.instagram {
            background: linear-gradient(to bottom, #E1306C, #833AB4);
        }

        .social-profiles a.facebook {
            background: linear-gradient(to bottom, #1877F2, #0A5CB8);
        }

        .social-profiles a.youtube {
            background: linear-gradient(to bottom, #FF0000, #CC0000);
        }

        /* Penjelasan Aplikasi */
        .app-description {
            background: #f0f5ff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: inset 0 0 15px #cce0ff;
            color: #0f2862;
            font-size: 16px;
            line-height: 1.7;
            position: relative;
        }

        .app-description h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            color: #0f2862;
        }

        .app-description p {
            margin-bottom: 20px;
        }

        .app-description::after {
            content: '"';
            position: absolute;
            bottom: 20px;
            right: 30px;
            font-size: 60px;
            color: rgba(0, 74, 173, 0.1);
            font-family: serif;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 25px;
            margin-top: 40px;
            color: #0f2862;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.7);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }

            .school-info {
                margin-bottom: 15px;
                justify-content: center;
            }

            .user-info {
                justify-content: center;
                margin-top: 10px;
            }

            .container {
                margin: 15px;
                padding: 25px 20px;
            }

            .menu {
                grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
                gap: 15px;
            }

            .menu-item {
                padding: 20px 15px;
                font-size: 16px;
            }

            .menu-item i {
                font-size: 32px;
            }

            .social-profiles {
                gap: 20px;
            }

            .social-profiles a {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }

            .app-description {
                padding: 20px;
            }
        }

        /* Style untuk pop-up */
        .modal {
            display: none;
            /* Sembunyikan secara default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 30px;
            border-radius: 10px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .modal-content h2 {
            color: #0f2862;
            margin-bottom: 20px;
        }

        .modal-content p {
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .modal-content button {
            background: linear-gradient(to right, #25D366, #128C7E);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-content button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 150, 50, 0.4);
        }

        .school-map {
            margin-top: 40px;
            text-align: center;
        }

        .school-map h2 {
            margin-bottom: 20px;
            color: #0f2862;
        }

        .map-container {
            max-width: 100%;
            border-radius: 12px;
            overflow: hidden;
        }

        /* ====== Tambahan Responsif ====== */
        @media (max-width: 992px) {
            .container {
                padding: 20px;
            }

            .data-table th,
            .data-table td {
                padding: 10px;
                font-size: 14px;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .school-info {
                flex-direction: column;
                align-items: center;
            }

            .user-info {
                margin-top: 15px;
            }

            .menu {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 12px;
            }

            .menu-item {
                padding: 18px 12px;
                font-size: 14px;
            }

            h1 {
                font-size: 22px;
            }

            h2 {
                font-size: 18px;
            }

            .social-profiles {
                flex-wrap: wrap;
                gap: 15px;
            }

            .social-profiles a {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 10px;
            }

            .school-logo {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }

            .menu-item i {
                font-size: 26px;
            }

            .menu-item span {
                font-size: 12px;
            }

            .data-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .student-info-card p {
                font-size: 14px;
            }

            .app-description {
                font-size: 14px;
            }

        }
    </style>
</head>

<body>
    <header class="header">
        <div class="school-info">
            <div class="school-logo">
                <img src="{{ asset('images/logo smk.png') }}" alt="Logo SMK" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <div>
                <h2>SMK Antartika 1 Sidoarjo</h2>
                <p>Bimbingan Konseling Digital</p>
            </div>
        </div>

        <div id="profile-container" class="user-info">
            <div class="user-details">
                <p><strong>{{ Auth::user()->name }}</strong></p>
            </div>
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>

            <div id="logout-dropdown" class="dropdown-menu">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                </form>
            </div>
        </div>
    </header>

    <div class="container">
        <h1>Dashboard</h1>

        <div class="description-box">
            <div class="description-icon">
                <i class="fas fa-lightbulb"></i>
            </div>
            <p>
                Halo, selamat datang di aplikasi layanan konseling. Anda dapat memeriksa data pelanggaran, melihat poin, atau berbagi cerita dan permasalahan secara pribadi dengan guru BK dan AI kami. Silakan pilih menu di bawah untuk melanjutkan. </p>
        </div>

        <nav class="menu" role="navigation" aria-label="Menu Pilihan Dashboard">
            <a href="{{ route('pelanggaran') }}" class="menu-item">
                <div class="menu-item-front">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Pelanggaran</span>
                </div>
                <div class="menu-item-back">
                    <span class="menu-item-desc">Lihat catatan pelanggaran</span>
                </div>
            </a>
            <a href="{{ route('poin') }}" class="menu-item">
                <div class="menu-item-front">
                    <i class="fas fa-star"></i>
                    <span>Poin</span>
                </div>
                <div class="menu-item-back">
                    <span class="menu-item-desc">Cek poin</span>
                </div>
            </a>
            <a href="{{ route('curhat-guru') }}" class="menu-item">
                <div class="menu-item-front">
                    <i class="fas fa-comments"></i>
                    <span>Curhat Guru</span>
                </div>
                <div class="menu-item-back">
                    <span class="menu-item-desc">Konsultasi dengan guru BK</span>
                </div>
            </a>
            <a href="{{ route('curhat_ai') }}" class="menu-item">
                <div class="menu-item-front">
                    <i class="fas fa-comments"></i>
                    <span>Curhat AI</span>
                </div>
                <div class="menu-item-back">
                    <span class="menu-item-desc">Dengarkan saran dari AI</span>
                </div>
            </a>
        </nav>


    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown untuk profil pengguna
            const profileContainer = document.getElementById('profile-container');
            const logoutDropdown = document.getElementById('logout-dropdown');

            profileContainer.addEventListener('click', function(event) {
                event.stopPropagation();
                logoutDropdown.classList.toggle('show');
            });

            window.addEventListener('click', function(event) {
                if (!profileContainer.contains(event.target)) {
                    logoutDropdown.classList.remove('show');
                }
            });
        });
    </script>
    <footer class="footer">
        <p>&copy; 2025 SMK Antartika 1 Sidoarjo. All rights reserved.</p>
        <p>Versi 1.0.0</p>
    </footer>
    </div>
    </section>
</body>

</html>