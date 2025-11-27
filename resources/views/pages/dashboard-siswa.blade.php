<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Siswa - SMK Antartika 1 Sidoarjo</title>
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
            background: linear-gradient(to right, #003366, #004aad);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .school-info {
            display: flex;
            align-items: center;
        }

        .school-logo {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #004aad;
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
            color: #004aad;
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
            color: #003366;
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
            background: linear-gradient(to right, #003366, #004aad);
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: 700;
            color: #003366;
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
            background: linear-gradient(to right, #003366, #004aad);
            border-radius: 2px;
        }
        
        h2 {
            color: #004aad;
            font-size: 24px;
            margin-top: 40px;
            margin-bottom: 20px;
            padding-left: 10px;
    
        }

        h3 {
            color: #003366;
            font-size: 20px;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        /* Menu pilihan */
        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }
        
        .menu-item {
            background: linear-gradient(to bottom, #004aad, #003366);
            color: white;
            padding: 30px 20px;
            border-radius: 12px;
            text-align: center;
            font-weight: 600;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 6px 15px rgba(0, 74, 173, 0.4);
            transition: all 0.3s ease;
            user-select: none;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            transition: all 0.5s ease;
            opacity: 0;
        }

        .menu-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 74, 173, 0.5);
        }

        .menu-item:hover::before {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .menu-item i {
            font-size: 40px;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .menu-item span {
            position: relative;
            z-index: 1;
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

        .data-table th, .data-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e7ee;
        }

        .data-table thead {
            background-color: #004aad;
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
            color: #003366;
            margin-top: 30px;
        }

        .student-info-card p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .student-info-card strong {
            color: #004aad;
        }


        /* Profil Sosial Media Sekolah */
        .social-section {
            margin-bottom: 40px;
        }

        .social-section h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #003366;
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
            color: #003366;
            font-size: 16px;
            line-height: 1.7;
            position: relative;
        }

        .app-description h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            color: #004aad;
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
            color: #003366;
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
            display: none; /* Sembunyikan secara default */
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
            color: #004aad;
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
    color: #004aad;
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

    .data-table th, .data-table td {
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
                <i class="fas fa-school"></i>
            </div>
            <div>
                <h2>SMK Antartika 1 Sidoarjo</h2>
                <p>Bimbingan Konseling Digital</p>
            </div>
        </div>

        <div id="profile-container" class="user-info">
            <div class="user-details">
                <p>Halo, <strong>{{ Auth::user()->name }}</strong></p>
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
        <h1>Dashboard Siswa</h1>

        <nav class="menu" role="navigation" aria-label="Menu Pilihan Dashboard">
            <a href="{{ route('pelanggaran') }}" class="menu-item">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Pelanggaran</span>
            </a>
            <a href="{{ route('poin') }}" class="menu-item">
                <i class="fas fa-star"></i>
                <span>Poin</span>
            </a>
            <a href="{{ route('jurusan') }}" class="menu-item">
                <i class="fas fa-graduation-cap"></i>
                <span>Jurusan</span>
            </a>
<a href="{{ route('curhat-guru') }}" class="menu-item">
    <i class="fas fa-comments"></i>
    <span>Curhat Guru</span>
</a>
<a href="http://localhost:3000/" target="_blank" class="menu-item">
    <i class="fas fa-robot"></i>
    <span>Curhat AI</span>
</a>
        </nav>
        
        @if (Auth::check() && in_array(Auth::user()->role, ['admin', 'guru_bk']))
            <h1>Menu Admin & Guru BK</h1>
            <nav class="menu">
                <a href="{{ route('kasus.page') }}" class="menu-item">
                    <i class="fas fa-briefcase"></i>
                    <span>Kasus</span>
                </a>
                <a href="{{ route('kasus.create') }}" class="menu-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>Tambah Kasus</span>
                </a>
                <a href="{{ route('kelola.users') }}" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Kelola Pengguna</span>
                </a>
                <a href="{{ route('kelola.pelanggaran') }}" class="menu-item">
                    <i class="fas fa-user-lock"></i>
                    <span>Kelola Pelanggaran</span>
                </a>
            </nav>
            
            <h2>Kelola Data Siswa</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

<h2>Kelola Kasus</h2>
<table class="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Siswa</th>
            <th>Tanggal</th>
            <th>Deskripsi Kasus</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($kasus as $index => $k)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $k->nama_siswa }}</td>
            <td>{{ $k->created_at->format('d-m-Y') }}</td>
            <td>{{ $k->pelanggaran }}</td>
            <td class="action-buttons">
                <button>Lihat Detail</button>
                <button>Edit</button>
                <button>Hapus</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">Belum ada kasus</td>
        </tr>
        @endforelse
    </tbody>
</table>


        @endif

        <section class="app-description">
            <h2>Apa Itu Aplikasi Bimbingan Konseling SMK Antartika 1 Sidoarjo?</h2>
            <p>
                Aplikasi Bimbingan Konseling SMK Antartika 1 Sidoarjo adalah sebuah platform digital yang dirancang untuk membantu siswa, guru, dan staf sekolah dalam mengelola dan memantau kegiatan bimbingan konseling.
                Melalui aplikasi ini, pelanggaran, poin, kasus, dan jurusan siswa dapat dikelola dengan lebih mudah dan terstruktur.
                Dengan adanya aplikasi ini, diharapkan proses bimbingan konseling menjadi lebih efektif, transparan, dan mendukung perkembangan siswa secara optimal di SMK Antartika 1 Sidoarjo.
            </p>
        </section>
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
