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
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand i {
            font-size: 28px;
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
            position: relative;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(to right, #003366, #004aad);
            border-radius: 16px 16px 0 0;
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

        header h1 i {
            font-size: 32px;
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

        .btn-primary:hover {
            background: linear-gradient(to right, #003366, #002244);
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

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
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

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
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

            .table-responsive {
                border-radius: 8px;
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

        /* === LOADING & STATUS === */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(0, 74, 173, 0.2);
            border-radius: 50%;
            border-top-color: #004aad;
            animation: spin 1s ease infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
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
            <a onclick="showSection('tata-tertib')"><i class="fas fa-book-open"></i> Tata Tertib</a>
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
                            <th>STATUS</th>
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
                            <th>STATUS</th>
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
                <h1><i class="fas fa-book-open"></i> Daftar Tata Tertib & Sanksi</h1>
                <button class="add-button" onclick="showAddTataTertibModal()">
                    <i class="fas fa-plus"></i> Tambah Tata Tertib
                </button>
            </header>
            <div class="table-responsive">
                <table id="tataTertibTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KATEGORI</th>
                            <th>PELANGGARAN</th>
                            <th>POIN</th>
                            <th>PENANGANAN</th>
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
                <div class="form-group">
                    <label for="poinValue">Poin *</label>
                    <input type="number" id="poinValue" required min="0" step="1" readonly>
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan (Opsional)</label>
                    <textarea id="catatan" placeholder="Masukkan catatan tambahan..."></textarea>
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
                    <label for="namaPelanggaran">Nama Pelanggaran *</label>
                    <input type="text" id="namaPelanggaran" required>
                </div>
                <div class="form-group">
                    <label for="jumlahPoin">Jumlah Poin *</label>
                    <input type="number" id="jumlahPoin" required min="1" step="1">
                </div>
                <div class="form-group">
                    <label for="caraPenanganan">Cara Penanganan *</label>
                    <textarea id="caraPenanganan" required placeholder="Masukkan cara penanganan..."></textarea>
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

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        let studentsData = [];
        let casesData = [];
        let usersData = [];

        // --- FUNGSI API CALLS ---
        async function fetchSiswa() {
            try {
                const response = await fetch('/api/siswa-list', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                if (!response.ok) throw new Error('Failed to fetch siswa');
                const siswaList = await response.json();

                // Asumsi data siswa dari API mencakup kelas dan jurusan
                studentsData = siswaList.map(s => ({
                    id: s.id,
                    nama_lengkap: s.nama_lengkap,
                    email: s.email,
                    kelas: s.kelas,
                    jurusan: s.jurusan
                }));
                populateStudentSelect();
                renderSiswaTable();
            } catch (error) {
                console.error('Error fetching siswa:', error);
                // alert('Gagal memuat data siswa'); 
            }
        }

        async function fetchKasus() {
            try {
                const response = await fetch('/api/kasus', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                if (!response.ok) throw new Error('Failed to fetch kasus');
                const kasusList = await response.json();
                casesData = kasusList.map(k => ({
                    id: k.id,
                    nama_siswa: k.nama_siswa,
                    pelanggaran: k.pelanggaran,
                    poin: k.poin,
                    penanggungJawab: k.penanggungJawab,
                    tanggal: k.tanggal
                }));
                renderKasusTable();
            } catch (error) {
                console.error('Error fetching kasus:', error);
                // alert('Gagal memuat data kasus');
            }
        }

        async function submitKasus(formData) {
            try {
                const endpoint = formData.kasusId ? `/api/kasus/${formData.kasusId}` : '/api/kasus';
                const method = formData.kasusId ? 'PUT' : 'POST';
                const response = await fetch(endpoint, {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        siswa_id: formData.siswaId,
                        pelanggaran: formData.pelanggaran,
                        poin: formData.poin,
                        catatan: formData.catatan
                    })
                });

                if (!response.ok) {
                    const text = await response.text();
                    throw new Error(text.substring(0, 300) || 'Server error');
                }
                await fetchKasus();
                hideModal();
                return true;
            } catch (error) {
                console.error('Error:', error);
                alert('Error: ' + error.message);
                return false;
            }
        }

        async function deleteKasusApi(kasusId) {
            if (!window.confirm('Yakin ingin menghapus kasus ini?')) return;
            try {
                const response = await fetch(`/api/kasus/${kasusId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                if (!response.ok) throw new Error('Failed to delete');
                await fetchKasus();
            } catch (error) {
                alert('Error: ' + error.message);
            }
        }

        // --- FUNGSI NAVIGASI & TAMPILAN ---
        function toggleDropdown() {
            document.getElementById("profileDropdown").classList.toggle("show");
        }

        function showSection(sectionId) {
            document.querySelectorAll('.content-section').forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }

        // --- RENDER TABLE & LOGIC ---
        function renderSiswaTable() {
            const tableBody = document.getElementById('siswaTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';
            const totalPoinMap = {};
            casesData.forEach(kasus => totalPoinMap[kasus.nama_siswa] = (totalPoinMap[kasus.nama_siswa] || 0) + kasus.poin);

            const studentStatus = studentsData.map(siswa => ({
                    ...siswa,
                    totalPoin: totalPoinMap[siswa.nama_lengkap] || 0
                }))
                .sort((a, b) => (a.nama_lengkap || '').localeCompare(b.nama_lengkap || ''));

            studentStatus.forEach((siswa, index) => {
                const row = tableBody.insertRow();
                row.insertCell().textContent = index + 1;
                row.insertCell().textContent = siswa.nama_lengkap;
                row.insertCell().textContent = siswa.kelas || '-';
                row.insertCell().textContent = siswa.jurusan || '-';

                const badgeColor = siswa.totalPoin > 100 ? '#b71c1c' : siswa.totalPoin > 50 ? '#e65100' : '#2e7d32';
                row.insertCell().innerHTML = `<span class="poin-badge" style="background-color: ${badgeColor};">${siswa.totalPoin}</span>`;

                row.insertCell().innerHTML = siswa.totalPoin > 0 ?
                    `<button class="detail-btn" onclick="showDetailModal('${siswa.nama_lengkap}')">Lihat ${siswa.totalPoin} Poin</button>` : 'Tidak ada kasus';

                row.insertCell().innerHTML = `<button class="siswa-edit-btn" style="border:none; border-radius:4px; padding:6px 10px; color:white; cursor:pointer;" onclick="showAddModal(true, '${siswa.nama_lengkap}', ${siswa.id})">Tambah Kasus</button>`;
            });
        }

        function renderKasusTable() {
            const tableBody = document.getElementById('kasusTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';
            const sortedCases = [...casesData].sort((a, b) => new Date(b.tanggal) - new Date(a.tanggal));

            const getStudentDetails = (namaSiswa) => {
                const siswa = studentsData.find(s => s.nama_lengkap === namaSiswa);
                return {
                    kelas: siswa ? siswa.kelas : '-',
                    jurusan: siswa ? siswa.jurusan : '-'
                };
            };

            sortedCases.forEach((kasus, index) => {
                const details = getStudentDetails(kasus.nama_siswa);
                const row = tableBody.insertRow();
                row.insertCell().textContent = index + 1;
                row.insertCell().textContent = kasus.nama_siswa;
                row.insertCell().textContent = details.kelas;
                row.insertCell().textContent = details.jurusan;
                row.insertCell().textContent = kasus.pelanggaran;
                row.insertCell().innerHTML = `<span class="poin-badge">${kasus.poin}</span>`;
                row.insertCell().innerHTML = `<button class="edit-btn" style="border:none; border-radius:4px; padding:6px 10px; color:white; cursor:pointer; margin-right:5px;" onclick="editKasus(${kasus.id})">Edit</button><button class="delete-btn" style="border:none; border-radius:4px; padding:6px 10px; color:white; cursor:pointer;" onclick="deleteKasusApi(${kasus.id})">Hapus</button>`;
            });
            renderSiswaTable();
        }

        // --- HELPERS (Populate, Modal Show/Hide) ---
        function populateStudentSelect() {
            const selectNama = document.getElementById('nama');
            selectNama.innerHTML = '<option value="">-- Pilih Siswa --</option>';
            studentsData.forEach(siswa => {
                const option = document.createElement('option');
                option.value = siswa.id;
                option.textContent = siswa.nama_lengkap;
                option.dataset.siswaNama = siswa.nama_lengkap;
                option.dataset.siswaKelas = siswa.kelas;
                option.dataset.siswaJurusan = siswa.jurusan;
                selectNama.appendChild(option);
            });
        }

        function updateKelasJurusan() {
            const select = document.getElementById('nama');
            const opt = select.options[select.selectedIndex];
            document.getElementById('siswaNama').dataset.siswaNama = opt.dataset.siswaNama;
            document.getElementById('siswaNama').dataset.siswaId = opt.value;
        }

        function showAddModal(quick = false, name = '', id = null) {
            document.getElementById('modalTitle').textContent = 'Tambah Kasus Baru';
            document.getElementById('kasusId').value = '';
            document.getElementById('kasusForm').reset();
            const select = document.getElementById('nama');
            select.disabled = false;
            if (quick) {
                select.value = id;
                select.disabled = true;
                document.getElementById('siswaNama').dataset.siswaId = id;
                document.getElementById('siswaNama').dataset.siswaNama = name;
            }
            document.getElementById('kasusModal').style.display = 'block';
        }

        function hideModal() {
            document.getElementById('kasusModal').style.display = 'none';
        }

        function editKasus(id) {
            const kasus = casesData.find(k => k.id === id);
            if (!kasus) return;
            document.getElementById('modalTitle').textContent = 'Edit Kasus';
            document.getElementById('kasusId').value = kasus.id;
            const opt = document.querySelector(`#nama option[data-siswa-nama="${kasus.nama_siswa}"]`);
            if (opt) {
                document.getElementById('nama').value = opt.value;
                document.getElementById('siswaNama').dataset.siswaId = opt.value;
            }
            document.getElementById('pelanggaran').value = kasus.pelanggaran;
            document.getElementById('poin').value = kasus.poin;
            document.getElementById('nama').disabled = true;
            document.getElementById('kasusModal').style.display = 'block';
        }

        document.getElementById('kasusForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const siswaId = document.getElementById('nama').value;
            if (!siswaId) return alert('Pilih siswa');
            await submitKasus({
                kasusId: document.getElementById('kasusId').value,
                siswaId: parseInt(siswaId),
                pelanggaran: document.getElementById('pelanggaran').value,
                poin: parseInt(document.getElementById('poin').value)
            });
            document.getElementById('nama').disabled = false;
        });

        function showDetailModal(name) {
            document.getElementById('detailSiswaName').textContent = name;
            const list = document.getElementById('pelanggaranList');
            list.innerHTML = '';
            const history = casesData.filter(k => k.nama_siswa === name).sort((a, b) => new Date(b.tanggal) - new Date(a.tanggal));
            if (history.length === 0) list.innerHTML = '<li>Tidak ada riwayat.</li>';
            else history.forEach(h => list.innerHTML += `<li><div>[${h.tanggal || 'N/A'}] ${h.pelanggaran}<br><small>Oleh: ${h.penanggungJawab || '-'}</small></div><strong>-${h.poin} Poin</strong></li>`);
            document.getElementById('detailModal').style.display = 'block';
        }

        function hideDetailModal() {
            document.getElementById('detailModal').style.display = 'none';
        }

        function hideUserModal() {
            document.getElementById('userModal').style.display = 'none';
        }

        window.onclick = function(e) {
            if (!e.target.matches('.profile-btn') && !e.target.closest('.profile-btn')) {
                const dd = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dd.length; i++)
                    if (dd[i].classList.contains('show')) dd[i].classList.remove('show');
            }
            if (e.target.className === 'modal') e.target.style.display = "none";
        }

        window.onload = async function() {
            await fetchSiswa();
            await fetchKasus();
        };
    </script>
</body>

</html>