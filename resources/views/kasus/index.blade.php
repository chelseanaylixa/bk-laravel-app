<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin/Guru BK - Bimbingan Konseling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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

        /* === NAVBAR === */
        .navbar {
            background: linear-gradient(to right, #003366, #004aad);
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            flex-wrap: wrap;
            gap: 15px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 6px;
            transition: all 0.3s;
            font-weight: 500;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .profile-menu {
            position: relative;
        }

        .profile-btn {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .profile-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
            z-index: 1000;
            top: 100%;
            margin-top: 5px;
        }

        .dropdown-content.show {
            display: block;
        }

        .dropdown-content a {
            color: #003366;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            transition: background-color 0.2s;
        }

        .dropdown-content a:hover {
            background-color: #f0f5ff;
        }

        .dropdown-content a.logout-link {
            color: #d32f2f;
            font-weight: 600;
            border-top: 1px solid #e0e0e0;
        }

        /* === CONTAINER === */
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 30px;
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        header {
            background: linear-gradient(to right, #003366, #004aad);
            color: white;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        h2 {
            color: #003366;
            border-bottom: 3px solid #004aad;
            padding-bottom: 10px;
            margin-top: 30px;
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: 600;
        }

        /* === TABLE === */
        .table-responsive {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead th {
            background: linear-gradient(to right, #003366, #004aad);
            color: white;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            border: none;
            white-space: nowrap;
        }

        table tbody tr {
            border-bottom: 1px solid #e0e7ee;
            transition: background-color 0.2s;
        }

        table tbody tr:hover {
            background-color: #f0f5ff;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9fbfd;
        }

        table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            font-size: 14px;
        }

        /* === BADGES & BUTTONS === */
        .poin-badge {
            display: inline-block;
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            color: white;
            padding: 8px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 13px;
            min-width: 45px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(255, 107, 107, 0.3);
        }

        .btn {
            border: none;
            padding: 10px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: linear-gradient(to right, #004aad, #003366);
            color: white;
        }

        .btn-success {
            background: linear-gradient(to right, #28a745, #20c997);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(to right, #ffc107, #ff9800);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(to right, #dc3545, #c82333);
            color: white;
        }

        .btn-info {
            background: linear-gradient(to right, #17a2b8, #138496);
            color: white;
        }

        .btn-group {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .add-button {
            background: linear-gradient(to right, #28a745, #20c997);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .add-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(40, 167, 69, 0.3);
        }

        /* === MODAL === */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(3px);
            overflow-y: auto;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 600px;
            position: relative;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close-button {
            color: #999;
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 32px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s;
        }

        .close-button:hover {
            color: #d32f2f;
        }

        .modal-content h3 {
            color: #003366;
            margin-bottom: 20px;
            font-size: 24px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e0e7ee;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #003366;
            font-size: 14px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e7ee;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            transition: all 0.3s;
            background-color: white;
            color: #0d1a40;
        }

        .form-group select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23003366' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 20px;
            padding-right: 40px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #004aad;
            box-shadow: 0 0 0 4px rgba(0, 74, 173, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            justify-content: flex-end;
        }

        .save-button {
            background: linear-gradient(to right, #28a745, #20c997);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
        }

        .save-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(40, 167, 69, 0.3);
        }

        .cancel-button {
            background: #e0e0e0;
            color: #333;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .cancel-button:hover {
            background: #d0d0d0;
        }

        /* === PELANGGARAN LIST === */
        .pelanggaran-list {
            list-style: none;
            padding: 0;
            margin: 15px 0;
        }

        .pelanggaran-list li {
            background: #f0f5ff;
            border-left: 4px solid #004aad;
            padding: 15px;
            margin-bottom: 12px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .pelanggaran-info {
            flex: 1;
        }

        .pelanggaran-info p {
            margin: 4px 0;
            font-size: 14px;
        }

        .pelanggaran-info strong {
            color: #d32f2f;
            font-size: 16px;
        }

        /* === ALERT & MESSAGES === */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert.show {
            display: block;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-diproses {
            background: #fff3cd;
            color: #856404;
        }

        .status-selesai {
            background: #d4edda;
            color: #155724;
        }

        /* === RESPONSIVE === */
        @media (max-width: 1024px) {
            .container {
                padding: 20px;
            }

            table thead th,
            table tbody td {
                padding: 12px;
                font-size: 13px;
            }

            .btn {
                padding: 8px 12px;
                font-size: 12px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 12px 15px;
                gap: 10px;
            }

            .navbar-brand {
                font-size: 18px;
            }

            .nav-links {
                width: 100%;
                gap: 8px;
            }

            .nav-links a {
                flex: 1;
                text-align: center;
                min-width: 90px;
                padding: 8px 10px;
                font-size: 13px;
            }

            .container {
                margin: 15px;
                padding: 20px;
            }

            header {
                flex-direction: column;
                align-items: flex-start;
            }

            header h1 {
                width: 100%;
                font-size: 20px;
            }

            .add-button {
                width: 100%;
                justify-content: center;
            }

            table {
                font-size: 12px;
            }

            table thead th,
            table tbody td {
                padding: 10px 8px;
            }

            .btn-group {
                flex-direction: column;
                gap: 4px;
            }

            .btn {
                width: 100%;
                justify-content: center;
                padding: 8px 10px;
            }

            .modal-content {
                width: 95%;
                padding: 25px;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand {
                font-size: 16px;
            }

            .nav-links a {
                padding: 6px 8px;
                font-size: 11px;
            }

            header h1 {
                font-size: 16px;
            }

            h2 {
                font-size: 18px;
            }

            table {
                font-size: 11px;
            }

            table thead th,
            table tbody td {
                padding: 8px 6px;
            }

            .modal-content {
                padding: 20px;
            }

            .poin-badge {
                padding: 6px 10px;
                font-size: 11px;
            }
        }

        /* === SURVEI SECTION === */
        .survei-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            border-bottom: 2px solid #e0e0e0;
        }

        .survei-tab-btn {
            background: none;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            color: #004aad;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }

        .survei-tab-btn:hover {
            color: #003366;
            border-bottom-color: #003366;
        }

        .survei-tab-btn.active {
            color: white;
            background: linear-gradient(to right, #003366, #004aad);
            border-radius: 8px 8px 0 0;
            border-bottom-color: #004aad;
        }

        .survei-tab-content {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .survei-stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #003366, #004aad);
            color: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 52, 102, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 52, 102, 0.3);
        }

        .stat-card.sangat-puas {
            background: linear-gradient(135deg, #28a745, #20c997);
        }

        .stat-card.puas {
            background: linear-gradient(135deg, #17a2b8, #0dcaf0);
        }

        .stat-card.kurang-puas {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
        }

        .stat-card.tidak-puas {
            background: linear-gradient(135deg, #dc3545, #fd7e14);
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-percentage {
            font-size: 14px;
            opacity: 0.8;
        }

        .survei-chart-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Badges untuk status kepuasan */
        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-sangat_puas {
            background-color: #28a745;
            color: white;
        }

        .badge-puas {
            background-color: #17a2b8;
            color: white;
        }

        .badge-kurang_puas {
            background-color: #ffc107;
            color: #333;
        }

        .badge-tidak_puas {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="navbar-brand">
            <i class="fas fa-book"></i> Dashboard BK
        </div>
        <div class="nav-links">
            <a onclick="showSection('data-siswa')"><i class="fas fa-users"></i> Daftar Siswa</a>
            <a onclick="showSection('data-kasus')"><i class="fas fa-file-alt"></i> Riwayat Kasus</a>
            <a onclick="showSection('tata-tertib')"><i class="fas fa-book-open"></i> Pelanggaran</a>
            <a onclick="showSection('survei')"><i class="fas fa-poll"></i> Hasil Survei</a>
            @if(Auth::user() && Auth::user()->role === 'admin')
            <a onclick="showSection('all-users')"><i class="fas fa-shield-alt"></i> All User</a>
            @endif
        </div>
        <div class="profile-menu">
            <button class="profile-btn" onclick="toggleDropdown()">
                <i class="fas fa-user-circle"></i> {{ Auth::user()->name ?? 'Admin BK' }}
            </button>
            <div id="profileDropdown" class="dropdown-content">
                <a href="{{ route('logout') }}" class="logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="container">
        <!-- Alert Messages -->
        <div id="alertBox" class="alert"></div>

        <!-- Daftar Siswa Section -->
        <div id="data-siswa" class="content-section" style="display: block;">
            <header>
                <h1><i class="fas fa-users"></i> Daftar Siswa & Total Poin</h1>
            </header>
            <div class="table-responsive">
                <table id="siswaTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA SISWA</th>
                            <th>EMAIL</th>
                            <th>TOTAL POIN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- Riwayat Kasus Section -->
        <div id="data-kasus" class="content-section" style="display: none;">
            <header>
                <h1><i class="fas fa-file-alt"></i> Riwayat Data Kasus Siswa</h1>
                <button class="add-button" onclick="showAddKasusModal()">
                    <i class="fas fa-plus"></i> Tambah Kasus
                </button>
            </header>
            <div class="table-responsive">
                <table id="kasusTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA SISWA</th>
                            <th>PELANGGARAN</th>
                            <th>POIN</th>
                            <th>TANGGAL</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- Tata Tertib Section -->
        <div id="tata-tertib" class="content-section" style="display: none;">
            <header>
                <h1><i class="fas fa-book-open"></i> Daftar Pelanggaran</h1>
                <button class="add-button" onclick="showAddTataTertibModal()">
                    <i class="fas fa-plus"></i> Tambah Pelanggaran
                </button>
            </header>
            <div class="table-responsive">
                <table id="tataTertibTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KATEGORI</th>
                            <th>JENIS PELANGGARAN</th>
                            <th>SANKSI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- Survei Section -->
        <div id="survei" class="content-section" style="display: none;">
            <header>
                <h1><i class="fas fa-poll"></i> Hasil Survei Kepuasan Siswa</h1>
            </header>

            <!-- Tab Navigation -->
            <div class="survei-tabs">
                <button class="survei-tab-btn active" onclick="showSurveiTab('hasil-survei')">
                    <i class="fas fa-list"></i> Hasil Survei
                </button>
                <button class="survei-tab-btn" onclick="showSurveiTab('statistik-survei')">
                    <i class="fas fa-chart-pie"></i> Statistik
                </button>
            </div>

            <!-- Tab Content: Hasil Survei -->
            <div id="hasil-survei" class="survei-tab-content" style="display: block;">
                <div class="table-responsive">
                    <table id="surveiTable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>KEPUASAN</th>
                                <th>MASUKAN</th>
                                <th>TANGGAL</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <!-- Tab Content: Statistik -->
            <div id="statistik-survei" class="survei-tab-content" style="display: none;">
                <div class="survei-stats-container">
                    <div class="stat-card">
                        <div class="stat-label">Total Survei</div>
                        <div class="stat-number" id="total-survei">0</div>
                    </div>
                    <div class="stat-card sangat-puas">
                        <div class="stat-label">Sangat Puas</div>
                        <div class="stat-number" id="sangat-puas">0</div>
                        <div class="stat-percentage" id="persen-sangat-puas">0%</div>
                    </div>
                    <div class="stat-card puas">
                        <div class="stat-label">Puas</div>
                        <div class="stat-number" id="puas">0</div>
                        <div class="stat-percentage" id="persen-puas">0%</div>
                    </div>
                    <div class="stat-card kurang-puas">
                        <div class="stat-label">Kurang Puas</div>
                        <div class="stat-number" id="kurang-puas">0</div>
                        <div class="stat-percentage" id="persen-kurang-puas">0%</div>
                    </div>
                    <div class="stat-card tidak-puas">
                        <div class="stat-label">Tidak Puas</div>
                        <div class="stat-number" id="tidak-puas">0</div>
                        <div class="stat-percentage" id="persen-tidak-puas">0%</div>
                    </div>
                </div>
                <div class="survei-chart-container" style="margin-top: 30px;">
                    <canvas id="satisfactionChart" style="max-width: 500px; margin: 0 auto;"></canvas>
                </div>
            </div>
        </div>

        <!-- All Users Section (Admin Only) -->
        <div id="all-users" class="content-section" style="display: none;">
            <header>
                <h1><i class="fas fa-shield-alt"></i> Daftar Semua User & Role</h1>
            </header>
            <div class="table-responsive">
                <table id="allUsersTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>EMAIL</th>
                            <th>ROLE</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Kasus -->
    <div id="kasusModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeKasusModal()">&times;</span>
            <h3 id="modalTitle"><i class="fas fa-plus-circle"></i> Tambah Kasus Baru</h3>
            <form id="kasusForm">
                <input type="hidden" id="kasusId">
                <div class="form-group">
                    <label for="namaSiswa">Nama Siswa *</label>
                    <select id="namaSiswa" required onchange="updateStudentInfo()">
                        <option value="">-- Pilih Siswa --</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pelanggaranName">Jenis Pelanggaran *</label>
                    <select id="pelanggaranName" required onchange="updatePoinValue()">
                        <option value="">-- Pilih Pelanggaran --</option>
                    </select>
                </div>
                <div class="form-group" id="pelanggaranCustomGroup" style="display: none;">
                    <label for="pelanggaranCustom">Sebutkan Jenis Pelanggaran Lainnya *</label>
                    <input type="text" id="pelanggaranCustom" placeholder="Masukkan jenis pelanggaran custom...">
                </div>
                <div class="form-group">
                    <label for="poinValue">Poin *</label>
                    <input type="number" id="poinValue" required min="0" step="1">
                </div>

                <div class="form-actions">
                    <button type="button" class="cancel-button" onclick="closeKasusModal()">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="save-button">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail Pelanggaran -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeDetailModal()">&times;</span>
            <h3><i class="fas fa-history"></i> Riwayat Pelanggaran: <span id="detailSiswaName"></span></h3>
            <ul id="pelanggaranList" class="pelanggaran-list"></ul>
            <div class="form-actions">
                <button class="cancel-button" onclick="closeDetailModal()">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Tata Tertib -->
    <div id="tataTertibModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeTataTertibModal()">&times;</span>
            <h3 id="tataTertibModalTitle"><i class="fas fa-plus-circle"></i> Tambah Tata Tertib</h3>
            <form id="tataTertibForm">
                <input type="hidden" id="tataTertibId">
                <div class="form-group">
                    <label for="kategori">Kategori *</label>
                    <select id="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Akademik">Akademik</option>
                        <option value="Estetika">Estetika</option>
                        <option value="Etika">Etika</option>
                        <option value="Kedisiplinan">Kedisiplinan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenisPelanggaran">Jenis Pelanggaran *</label>
                    <input type="text" id="jenisPelanggaran" required>
                </div>
                <div class="form-group">
                    <label for="sanksi">Sanksi *</label>
                    <textarea id="sanksi" required placeholder="Masukkan sanksi..."></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="cancel-button" onclick="closeTataTertibModal()">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="save-button">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Role User -->
    <div id="editRoleModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeEditRoleModal()">&times;</span>
            <h3><i class="fas fa-edit"></i> Edit Role User</h3>
            <form id="editRoleForm">
                <input type="hidden" id="editUserId">
                <div class="form-group">
                    <label for="editUserName">Nama User</label>
                    <input type="text" id="editUserName" readonly style="background-color: #f0f0f0;">
                </div>
                <div class="form-group">
                    <label for="editUserEmail">Email</label>
                    <input type="email" id="editUserEmail" readonly style="background-color: #f0f0f0;">
                </div>
                <div class="form-group">
                    <label for="editUserRole">Role *</label>
                    <select id="editUserRole" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="guru_bk">Guru BK</option>
                        <option value="siswa">Siswa</option>
                        <option value="wali_murid">Wali Murid</option>
                        <option value="wali_kelas">Wali Kelas</option>

                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="cancel-button" onclick="closeEditRoleModal()">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="save-button">
                        <i class="fas fa-save"></i> Simpan Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        let studentsData = [];
        let kasusData = [];
        let tataTertibData = [];

        // ===== UTILITY FUNCTIONS =====
        function showAlert(message, type = 'info') {
            const alertBox = document.getElementById('alertBox');
            alertBox.textContent = message;
            alertBox.className = `alert show alert-${type}`;
            setTimeout(() => {
                alertBox.classList.remove('show');
            }, 4000);
        }

        function toggleDropdown() {
            document.getElementById("profileDropdown").classList.toggle("show");
        }

        function showSection(sectionId) {
            document.querySelectorAll('.content-section').forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }

        // ===== API CALLS - FETCH DATA =====
        async function fetchStudents() {
            try {
                const response = await fetch('/api/siswa-list', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!response.ok) throw new Error('Gagal memuat siswa');
                studentsData = await response.json();
                populateStudentSelect();
                renderSiswaTable();
                return true;
            } catch (error) {
                console.error('Error fetching students:', error);
                showAlert('Gagal memuat data siswa', 'error');
                return false;
            }
        }

        async function fetchKasus() {
            try {
                const response = await fetch('/api/kasus', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!response.ok) throw new Error('Gagal memuat kasus');
                kasusData = await response.json();
                renderKasusTable();
                renderSiswaTable();
                return true;
            } catch (error) {
                console.error('Error fetching kasus:', error);
                showAlert('Gagal memuat data kasus', 'error');
                return false;
            }
        }

        async function fetchTataTertib() {
            try {
                const response = await fetch('/api/tata-tertib', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!response.ok) throw new Error('Gagal memuat tata tertib');
                tataTertibData = await response.json();
                populatePelanggaranSelect();
                renderTataTertibTable();
                return true;
            } catch (error) {
                console.error('Error fetching tata tertib:', error);
                showAlert('Gagal memuat data tata tertib', 'error');
                return false;
            }
        }

        // ===== FETCH ALL USERS (ADMIN ONLY) =====
        let allUsersData = [];
        async function fetchAllUsers() {
            try {
                const response = await fetch('{{ route("get-all-users") }}', {
                    headers: {
                        'Accept': 'application/json'
                    },
                    credentials: 'include'
                });
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    console.warn('Failed to fetch users:', response.status, errorData);
                    if (response.status === 403) {
                        console.warn('Not authorized to view users. Requires admin role.');
                        showAlert('⚠️ Anda tidak memiliki akses untuk melihat semua user. Hanya admin yang bisa.', 'error');
                    }
                    return false;
                }
                allUsersData = await response.json();
                console.log('✅ Users loaded successfully:', allUsersData);
                renderAllUsersTable();
                return true;
            } catch (error) {
                console.error('Error fetching all users:', error);
                showAlert('❌ Gagal memuat data users: ' + error.message, 'error');
                return false;
            }
        }

        function renderAllUsersTable() {
            console.log('🔄 renderAllUsersTable called with', allUsersData.length, 'users');
            const tableBody = document.getElementById('allUsersTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';

            if (allUsersData.length === 0) {
                console.warn('⚠️ No users found in allUsersData');
                tableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 20px;">Tidak ada data user</td></tr>';
                return;
            }

            allUsersData.forEach((user, index) => {
                console.log(`📝 Rendering user ${index + 1}:`, user.email, user.status);
                const row = tableBody.insertRow();
                row.insertCell().textContent = index + 1;
                row.insertCell().textContent = user.name || '-';
                row.insertCell().textContent = user.email || '-';

                const roleCell = row.insertCell();
                const roleColors = {
                    'admin': '#d32f2f',
                    'guru_bk': '#ff9800',
                    'siswa': '#28a745',
                    'wali_murid': '#17a2b8',
                    'wali_kelas': '#111a61ff',
                    'pending': '#9e9e9e'
                };
                const roleDisplay = {
                    'admin': 'Admin',
                    'guru_bk': 'Guru BK',
                    'siswa': 'Siswa',
                    'wali_murid': 'Wali Murid',
                    'wali_kelas': 'Wali Kelas',
                    'pending': 'Pending'
                };
                const roleColor = roleColors[user.role] || '#666';
                const roleText = roleDisplay[user.role] || user.role;
                roleCell.innerHTML = `<span class="poin-badge" style="background: ${roleColor};">${roleText}</span>`;
                const actionCell = row.insertCell();
                actionCell.innerHTML = `
                    <div class="btn-group">
                        <button class="btn btn-warning" onclick="showEditRoleModal(${user.id}, '${user.name}', '${user.email}', '${user.role}')"><i class="fas fa-edit"></i> Edit</button>
                    </div>
                `;
            });
        }

        function showEditRoleModal(userId, userName, userEmail, userRole) {
            document.getElementById('editUserId').value = userId;
            document.getElementById('editUserName').value = userName;
            document.getElementById('editUserEmail').value = userEmail;
            document.getElementById('editUserRole').value = userRole;
            document.getElementById('editRoleModal').classList.add('active');
        }

        function closeEditRoleModal() {
            document.getElementById('editRoleModal').classList.remove('active');
        }

        // ===== RENDER TABLE FUNCTIONS =====
        function renderSiswaTable() {
            const tableBody = document.getElementById('siswaTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';

            if (studentsData.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 20px;">Tidak ada data siswa</td></tr>';
                return;
            }

            studentsData.forEach((siswa, index) => {
                const totalPoin = calculateTotalPoin(siswa.id);
                const status = totalPoin > 100 ? 'Kritis' : totalPoin > 50 ? 'Perlu Perhatian' : 'Baik';
                const statusColor = totalPoin > 100 ? '#d32f2f' : totalPoin > 50 ? '#ff9800' : '#28a745';

                const row = tableBody.insertRow();
                row.insertCell().textContent = index + 1;
                row.insertCell().textContent = siswa.nama_lengkap;
                row.insertCell().textContent = siswa.email || '-';

                const poinCell = row.insertCell();
                poinCell.innerHTML = `<span class="poin-badge" style="background: linear-gradient(135deg, ${statusColor}, ${statusColor})">${totalPoin}</span>`;

                const actionCell = row.insertCell();
                actionCell.innerHTML = `
                    <div class="btn-group">
                        ${totalPoin > 0 ? `<button class="btn btn-info" onclick="showDetailModal('${siswa.nama_lengkap}', ${siswa.id})"><i class="fas fa-eye"></i> Lihat</button>` : ''}
                        <button class="btn btn-primary" onclick="showAddKasusModal(${siswa.id}, '${siswa.nama_lengkap}')"><i class="fas fa-plus"></i> Kasus</button>
                    </div>
                `;
            });
        }

        function renderKasusTable() {
            const tableBody = document.getElementById('kasusTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';

            if (kasusData.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 20px;">Tidak ada data kasus</td></tr>';
                return;
            }

            const sortedKasus = [...kasusData].sort((a, b) => new Date(b.tanggal) - new Date(a.tanggal));

            sortedKasus.forEach((kasus, index) => {
                const row = tableBody.insertRow();
                row.insertCell().textContent = index + 1;
                row.insertCell().textContent = kasus.nama_siswa;
                row.insertCell().textContent = kasus.pelanggaran;

                const poinCell = row.insertCell();
                poinCell.innerHTML = `<span class="poin-badge">${kasus.poin}</span>`;

                row.insertCell().textContent = kasus.tanggal || new Date().toISOString().split('T')[0];

                const actionCell = row.insertCell();
                actionCell.innerHTML = `
                    <div class="btn-group">
                        <button class="btn btn-warning" onclick="editKasus(${kasus.id})"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="deleteKasus(${kasus.id})"><i class="fas fa-trash"></i></button>
                    </div>
                `;
            });
        }

        function renderTataTertibTable() {
            const tableBody = document.getElementById('tataTertibTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';

            if (tataTertibData.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="5" style="text-align: center; padding: 20px;">Tidak ada data tata tertib</td></tr>';
                return;
            }

            tataTertibData.forEach((item, index) => {
                const row = tableBody.insertRow();
                row.insertCell().textContent = index + 1;
                row.insertCell().textContent = item.kategori || '-';
                row.insertCell().textContent = item.jenis_pelanggaran || '-';
                row.insertCell().textContent = item.sanksi || '-';

                const actionCell = row.insertCell();
                actionCell.innerHTML = `
                    <div class="btn-group">
                        <button class="btn btn-warning" onclick="editTataTertib(${item.id})"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="deleteTataTertib(${item.id})"><i class="fas fa-trash"></i></button>
                    </div>
                `;
            });
        }

        // ===== MODAL FUNCTIONS =====
        function showAddKasusModal(siswaId = null, siswaNama = null) {
            document.getElementById('modalTitle').innerHTML = '<i class="fas fa-plus-circle"></i> Tambah Kasus Baru';
            document.getElementById('kasusForm').reset();
            document.getElementById('kasusId').value = '';

            const selectSiswa = document.getElementById('namaSiswa');
            if (siswaId) {
                selectSiswa.value = siswaId;
                selectSiswa.disabled = true;
                updateStudentInfo();
            } else {
                selectSiswa.disabled = false;
            }

            document.getElementById('kasusModal').classList.add('active');
        }

        function closeKasusModal() {
            document.getElementById('kasusModal').classList.remove('active');
            document.getElementById('namaSiswa').disabled = false;
        }

        function showDetailModal(siswaNama, siswaId) {
            document.getElementById('detailSiswaName').textContent = siswaNama;
            const list = document.getElementById('pelanggaranList');
            list.innerHTML = '';

            const studentKasus = kasusData.filter(k => k.siswa_id === siswaId || k.nama_siswa === siswaNama)
                .sort((a, b) => new Date(b.tanggal) - new Date(a.tanggal));

            if (studentKasus.length === 0) {
                list.innerHTML = '<li style="background: #d4edda; border-left: 4px solid #28a745; color: #155724;">Tidak ada riwayat pelanggaran</li>';
            } else {
                studentKasus.forEach(item => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <div class="pelanggaran-info">
                            <p><strong>${item.pelanggaran}</strong></p>
                            <p><small>Tanggal: ${item.tanggal}</small></p>
                            ${item.catatan ? `<p><small>Catatan: ${item.catatan}</small></p>` : ''}
                        </div>
                        <div><strong style="color: #d32f2f;">-${item.poin} Poin</strong></div>
                    `;
                    list.appendChild(li);
                });
            }

            document.getElementById('detailModal').classList.add('active');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.remove('active');
        }

        function showAddTataTertibModal(id = null) {
            document.getElementById('tataTertibModalTitle').innerHTML = id ? '<i class="fas fa-edit"></i> Edit Tata Tertib' : '<i class="fas fa-plus-circle"></i> Tambah Tata Tertib';
            document.getElementById('tataTertibForm').reset();
            document.getElementById('tataTertibId').value = id || '';

            if (id) {
                const item = tataTertibData.find(t => t.id === id);
                if (item) {
                    document.getElementById('kategori').value = item.kategori;
                    document.getElementById('jenisPelanggaran').value = item.jenis_pelanggaran;
                    document.getElementById('sanksi').value = item.sanksi;
                }
            }

            document.getElementById('tataTertibModal').classList.add('active');
        }

        function closeTataTertibModal() {
            document.getElementById('tataTertibModal').classList.remove('active');
        }

        // ===== HELPER FUNCTIONS =====
        function populateStudentSelect() {
            const select = document.getElementById('namaSiswa');
            select.innerHTML = '<option value="">-- Pilih Siswa --</option>';
            studentsData.forEach(siswa => {
                const option = document.createElement('option');
                option.value = siswa.id;
                option.textContent = siswa.nama_lengkap;
                option.dataset.email = siswa.email;
                select.appendChild(option);
            });
        }

        function populatePelanggaranSelect() {
            const select = document.getElementById('pelanggaranName');
            select.innerHTML = '<option value="">-- Pilih Pelanggaran --</option>';
            tataTertibData.forEach(item => {
                const option = document.createElement('option');
                option.value = item.jenis_pelanggaran;
                option.textContent = item.jenis_pelanggaran;
                option.dataset.sanksi = item.sanksi;
                option.dataset.id = item.id;
                select.appendChild(option);
            });
            // Tambah opsi pelanggaran custom
            const customOption = document.createElement('option');
            customOption.value = 'Pelanggaran Lainnya';
            customOption.textContent = 'Pelanggaran Lainnya';
            customOption.dataset.sanksi = '';
            customOption.dataset.id = 'custom';
            select.appendChild(customOption);
        }

        function updateStudentInfo() {
            // Placeholder untuk penggunaan nanti
        }

        function updatePoinValue() {
            const select = document.getElementById('pelanggaranName');
            const selected = select.options[select.selectedIndex];
            // Gunakan poin default 10 jika tidak ada di dataset
            document.getElementById('poinValue').value = selected.dataset.poin || 10;

            // Show/hide custom pelanggaran input
            const customGroup = document.getElementById('pelanggaranCustomGroup');
            if (select.value === 'Pelanggaran Lainnya') {
                customGroup.style.display = 'block';
                document.getElementById('pelanggaranCustom').required = true;
            } else {
                customGroup.style.display = 'none';
                document.getElementById('pelanggaranCustom').required = false;
                document.getElementById('pelanggaranCustom').value = '';
            }
        }

        function calculateTotalPoin(siswaId) {
            return kasusData
                .filter(k => k.siswa_id === siswaId)
                .reduce((sum, k) => sum + k.poin, 0);
        }

        // ===== EDIT & DELETE FUNCTIONS =====
        function editKasus(kasusId) {
            const kasus = kasusData.find(k => k.id === kasusId);
            if (!kasus) return;

            document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit"></i> Edit Kasus';
            document.getElementById('kasusId').value = kasus.id;
            document.getElementById('namaSiswa').value = kasus.siswa_id;
            document.getElementById('namaSiswa').disabled = true;
            document.getElementById('pelanggaranName').value = kasus.pelanggaran;
            document.getElementById('poinValue').value = kasus.poin;
            document.getElementById('catatan').value = kasus.catatan || '';

            document.getElementById('kasusModal').classList.add('active');
        }

        async function deleteKasus(kasusId) {
            if (!confirm('Yakin ingin menghapus kasus ini?')) return;

            try {
                const response = await fetch(`/api/kasus/${kasusId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Gagal menghapus kasus');

                await fetchKasus();
                showAlert('Kasus berhasil dihapus', 'success');
            } catch (error) {
                console.error('Error:', error);
                showAlert(`Gagal: ${error.message}`, 'error');
            }
        }

        function editTataTertib(id) {
            showAddTataTertibModal(id);
        }

        async function deleteTataTertib(id) {
            if (!confirm('Yakin ingin menghapus tata tertib ini?')) return;

            try {
                const response = await fetch(`/api/tata-tertib/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Gagal menghapus tata tertib');

                await fetchTataTertib();
                showAlert('Tata tertib berhasil dihapus', 'success');
            } catch (error) {
                console.error('Error:', error);
                showAlert(`Gagal: ${error.message}`, 'error');
            }
        }

        // ===== CLOSE MODALS ON OUTSIDE CLICK =====
        window.addEventListener('click', function(event) {
            const kasusModal = document.getElementById('kasusModal');
            const detailModal = document.getElementById('detailModal');
            const tataTertibModal = document.getElementById('tataTertibModal');
            const editRoleModal = document.getElementById('editRoleModal');

            if (event.target === kasusModal) {
                closeKasusModal();
            }
            if (event.target === detailModal) {
                closeDetailModal();
            }
            if (event.target === tataTertibModal) {
                closeTataTertibModal();
            }
            if (event.target === editRoleModal) {
                closeEditRoleModal();
            }
        });

        // ===== SURVEI FUNCTIONS =====
        function showSurveiTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.survei-tab-content').forEach(tab => {
                tab.style.display = 'none';
            });
            // Remove active class from all buttons
            document.querySelectorAll('.survei-tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            // Show selected tab and mark button as active
            document.getElementById(tabName).style.display = 'block';
            event.target.classList.add('active');

            // Load data jika tab statistik dipilih
            if (tabName === 'statistik-survei') {
                loadSurveiStatistics();
            }
        }

        async function loadSurveiData() {
            try {
                const response = await fetch('{{ route("api.survei.data") }}', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                const data = await response.json();

                const tbody = document.querySelector('#surveiTable tbody');
                tbody.innerHTML = '';

                if (data.survei && data.survei.length > 0) {
                    data.survei.forEach((item, index) => {
                        const kepuasanLabel = {
                            'sangat_puas': 'Sangat Puas',
                            'puas': 'Puas',
                            'kurang_puas': 'Kurang Puas',
                            'tidak_puas': 'Tidak Puas'
                        } [item.kepuasan] || item.kepuasan;

                        const row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.nama}</td>
                                <td>${item.email}</td>
                                <td><span class="badge badge-${item.kepuasan}">${kepuasanLabel}</span></td>
                                <td>${item.masukan ? item.masukan.substring(0, 50) + '...' : '-'}</td>
                                <td>${new Date(item.created_at).toLocaleDateString('id-ID')}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-danger" onclick="deleteSurvei(${item.id})"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tbody.insertAdjacentHTML('beforeend', row);
                    });
                } else {
                    tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 20px; color: #999;">Belum ada data survei</td></tr>';
                }
            } catch (error) {
                console.error('Error loading survei data:', error);
            }
        }

        async function deleteSurvei(surveiId) {
            if (!confirm('Yakin ingin menghapus data survei ini?')) return;

            try {
                const response = await fetch(`/api/survei/${surveiId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Gagal menghapus survei');
                }

                await loadSurveiData();
                showAlert('Survei berhasil dihapus', 'success');
            } catch (error) {
                console.error('Error:', error);
                showAlert(`Gagal: ${error.message}`, 'error');
            }
        }

        async function loadSurveiStatistics() {
            try {
                const response = await fetch('{{ route("api.survei.stats") }}', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                const stats = await response.json();

                // Update card values
                document.getElementById('total-survei').textContent = stats.total;
                document.getElementById('sangat-puas').textContent = stats.sangat_puas;
                document.getElementById('puas').textContent = stats.puas;
                document.getElementById('kurang-puas').textContent = stats.kurang_puas;
                document.getElementById('tidak-puas').textContent = stats.tidak_puas;

                // Calculate and update percentages
                if (stats.total > 0) {
                    document.getElementById('persen-sangat-puas').textContent = Math.round((stats.sangat_puas / stats.total) * 100) + '%';
                    document.getElementById('persen-puas').textContent = Math.round((stats.puas / stats.total) * 100) + '%';
                    document.getElementById('persen-kurang-puas').textContent = Math.round((stats.kurang_puas / stats.total) * 100) + '%';
                    document.getElementById('persen-tidak-puas').textContent = Math.round((stats.tidak_puas / stats.total) * 100) + '%';
                }

                // Load chart if Chart.js is available
                if (typeof Chart !== 'undefined') {
                    loadSurveiChart(stats);
                }
            } catch (error) {
                console.error('Error loading survei statistics:', error);
            }
        }

        function loadSurveiChart(stats) {
            const chartCanvas = document.getElementById('satisfactionChart');
            if (!chartCanvas) return;

            // Destroy existing chart if any
            if (window.surveiChart) {
                window.surveiChart.destroy();
            }

            const ctx = chartCanvas.getContext('2d');
            window.surveiChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Sangat Puas', 'Puas', 'Kurang Puas', 'Tidak Puas'],
                    datasets: [{
                        data: [stats.sangat_puas, stats.puas, stats.kurang_puas, stats.tidak_puas],
                        backgroundColor: [
                            '#28a745',
                            '#17a2b8',
                            '#ffc107',
                            '#dc3545'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // ===== INITIALIZE PAGE =====
        window.addEventListener('DOMContentLoaded', async function() {
            await fetchStudents();
            await fetchKasus();
            await fetchTataTertib();
            await fetchAllUsers();
            await loadSurveiData();

            // ===== FORM SUBMISSIONS (Tambahkan di sini SETELAH DOM loaded) =====
            document.getElementById('kasusForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const siswaId = document.getElementById('namaSiswa').value;
                if (!siswaId) {
                    showAlert('Pilih siswa terlebih dahulu', 'error');
                    return;
                }

                const kasusId = document.getElementById('kasusId').value;
                let pelanggaranName = document.getElementById('pelanggaranName').value;
                const poin = parseInt(document.getElementById('poinValue').value);
                const catatan = document.getElementById('catatan')?.value || '';

                if (pelanggaranName === 'Pelanggaran Lainnya') {
                    const customPelanggaran = document.getElementById('pelanggaranCustom').value;
                    if (!customPelanggaran.trim()) {
                        showAlert('Masukkan jenis pelanggaran lainnya', 'error');
                        return;
                    }
                    pelanggaranName = customPelanggaran;
                }

                const endpoint = kasusId ? `/api/kasus/${kasusId}` : '/api/kasus';
                const method = kasusId ? 'PUT' : 'POST';

                try {
                    const response = await fetch(endpoint, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            siswa_id: parseInt(siswaId),
                            pelanggaran: pelanggaranName,
                            poin: poin,
                            catatan: catatan
                        })
                    });

                    if (!response.ok) {
                        const error = await response.json();
                        throw new Error(error.message || 'Gagal menyimpan kasus');
                    }

                    await fetchKasus();
                    closeKasusModal();
                    showAlert(kasusId ? 'Kasus berhasil diperbarui' : 'Kasus berhasil ditambahkan', 'success');
                } catch (error) {
                    console.error('Error:', error);
                    showAlert(`Gagal: ${error.message}`, 'error');
                }
            });

            // Event listener untuk tataTertibForm
            document.getElementById('tataTertibForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const tataTertibId = document.getElementById('tataTertibId').value;
                const kategori = document.getElementById('kategori').value;
                const jenisPelanggaran = document.getElementById('jenisPelanggaran').value;
                const sanksi = document.getElementById('sanksi').value;

                const endpoint = tataTertibId ? `/api/tata-tertib/${tataTertibId}` : '/api/tata-tertib';
                const method = tataTertibId ? 'PUT' : 'POST';

                try {
                    const response = await fetch(endpoint, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            kategori,
                            jenis_pelanggaran: jenisPelanggaran,
                            sanksi: sanksi
                        })
                    });

                    if (!response.ok) {
                        const error = await response.json();
                        throw new Error(error.message || 'Gagal menyimpan tata tertib');
                    }

                    await fetchTataTertib();
                    closeTataTertibModal();
                    showAlert(tataTertibId ? 'Tata tertib berhasil diperbarui' : 'Tata tertib berhasil ditambahkan', 'success');
                } catch (error) {
                    console.error('Error:', error);
                    showAlert(`Gagal: ${error.message}`, 'error');
                }
            });

            // Event listener untuk editRoleForm
            document.getElementById('editRoleForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const userId = document.getElementById('editUserId').value;
                const userRole = document.getElementById('editUserRole').value;

                try {
                    const response = await fetch('{{ route("update-user-role") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            id: userId,
                            role: userRole
                        }),
                        credentials: 'include'
                    });

                    if (!response.ok) {
                        const error = await response.json();
                        throw new Error(error.message || 'Gagal mengubah role user');
                    }

                    await fetchAllUsers();
                    closeEditRoleModal();
                    showAlert('Role user berhasil diperbarui', 'success');
                } catch (error) {
                    console.error('Error:', error);
                    showAlert(`Gagal: ${error.message}`, 'error');
                }
            });
        });
    </script>
</body>

</html>