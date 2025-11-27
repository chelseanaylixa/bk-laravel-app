<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin/Guru BK</title>
    <style>
        /* CSS Styling Bernuansa Biru */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e3f2fd;
            /* Biru Sangat Muda */
            color: #333;
        }

        /* --- NAVBAR STYLING (NEW) --- */
        .navbar {
            background-color: #0d47a1;
            /* Biru Tua */
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
        }

        .nav-links a,
        .profile-btn {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 4px;
            transition: background-color 0.3s;
            font-weight: 500;
        }

        .nav-links a:hover {
            background-color: #1565c0;
        }

        /* Profile Dropdown */
        .profile-menu {
            position: relative;
            display: inline-block;
        }

        .profile-btn {
            background-color: #1e88e5;
            /* Biru Cerah */
            border: none;
            cursor: pointer;
            padding: 10px 15px;
            display: flex;
            align-items: center;
        }

        .profile-btn:hover {
            background-color: #42a5f5;
        }

        .dropdown-content {
            display: none;
            /* Default: Sembunyi */
            position: absolute;
            right: 0;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 6px;
            overflow: hidden;
            margin-top: 5px;
        }

        /* ATURAN INI UNTUK MENAMPILKAN DROPDOWN KETIKA JAVASCRIPT MENAMBAHKAN CLASS 'show' */
        .dropdown-content.show {
            display: block;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        /* Logout Link Styling */
        .dropdown-content a.logout-link {
            color: #d32f2f;
            /* Merah */
            font-weight: 600;
        }

        /* --- END NAVBAR STYLING --- */

        .container {
            max-width: 1300px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        /* Header (disesuaikan agar tidak konflik dengan navbar) */
        header {
            background-color: #1e88e5;
            /* Biru Cerah */
            color: white;
            padding: 15px 20px;
            border-radius: 10px 10px 10px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        /* H2 styling */
        h2 {
            color: #1565c0;
            border-bottom: 2px solid #bbdefb;
            padding-bottom: 5px;
            margin-top: 30px;
            font-size: 22px;
            font-weight: 500;
        }

        /* Tabel Styling */
        .table-responsive {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            /* Jarak antar tabel */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        table thead th {
            background-color: #1565c0;
            /* Biru Sedang */
            color: white;
            padding: 14px 15px;
            text-align: left;
            border: 1px solid #1976d2;
            font-weight: 600;
            white-space: nowrap;
        }

        table tbody tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        table tbody tr:hover {
            background-color: #e8eaf6;
            /* Hover biru muda */
        }

        table tbody td {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            vertical-align: middle;
            font-size: 14px;
        }

        /* Poin Styling */
        .poin-badge {
            display: inline-block;
            background-color: #e53935;
            /* Merah untuk poin (negatif) */
            color: white;
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 13px;
            min-width: 40px;
            text-align: center;
        }

        /* Tombol Detail Pelanggaran */
        .detail-btn {
            background-color: #039be5;
            /* Biru muda untuk detail */
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
        }

        .detail-btn:hover {
            background-color: #03a9f4;
        }


        /* Aksi Button Styling */
        .action-group button {
            color: white;
            border: none;
            padding: 8px 12px;
            margin: 2px;
            border-radius: 4px;
            cursor: pointer;
            transition: opacity 0.3s;
            font-size: 13px;
            font-weight: 500;
        }

        .edit-btn {
            background-color: #ffb300;
            /* Kuning */
        }

        .delete-btn {
            background-color: #e53935;
            /* Merah */
        }

        /* Style baru untuk tombol edit di tabel ringkasan siswa */
        .siswa-edit-btn {
            background-color: #1e88e5;
            /* Biru Cerah */
        }

        .user-action-btn {
            background-color: #43a047;
            /* Hijau */
        }

        .action-group button:hover {
            opacity: 0.9;
        }

        /* Modal Styling (sama seperti sebelumnya) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 30px;
            width: 90%;
            max-width: 550px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        /* Style untuk list pelanggaran di modal detail */
        .pelanggaran-list {
            list-style: none;
            padding: 0;
        }

        .pelanggaran-list li {
            background-color: #e3f2fd;
            border: 1px solid #bbdefb;
            margin-bottom: 8px;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .pelanggaran-list li strong {
            color: #d32f2f;
        }


        .close-button {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 30px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: #0d47a1;
            text-decoration: none;
            cursor: pointer;
        }

        /* ... (CSS form modal lainnya) ... */
        .modal-content label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: 600;
            color: #1565c0;
        }

        .modal-content input,
        .modal-content select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #b3e5fc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        .save-button {
            background-color: #4caf50;
            /* Hijau untuk Simpan */
            color: white;
            border: none;
            padding: 12px 15px;
            margin-top: 30px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="navbar-brand">
            Dashboard BK
        </div>
        <div class="nav-links">
            <a href="#data-siswa" onclick="showSection('data-siswa')">Daftar Siswa</a>
            <a href="#data-kasus" onclick="showSection('data-kasus')">Riwayat Kasus</a>
        </div>

        <div class="profile-menu">
            <button class="profile-btn" onclick="toggleDropdown()">
                Halo, {{ Auth::user()->name ?? 'Admin BK' }}
            </button>
            <div id="profileDropdown" class="dropdown-content">
                <a href="{{ route('logout') }}"
                    class="logout-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="container">
        <div id="data-siswa" class="content-section" style="display: block;">
            <h2>Daftar Siswa & Total Poin (Monitor)</h2>
            <div class="table-responsive">
                <table id="siswaTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA SISWA</th>
                            <th>KELAS</th>
                            <th>JURUSAN</th>
                            <th>TOTAL POIN</th>
                            <th>RIWAYAT PELANGGARAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="data-kasus" class="content-section" style="display: none;">
            <header>
                <div style="display: flex; align-items: center;">
                    <i class="icon"></i>
                    <h1>Riwayat Data Kasus Siswa</h1>
                </div>
                <button class="add-button" onclick="showAddModal()">+ Tambah Kasus</button>
            </header>
            <div class="table-responsive">
                <table id="kasusTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA SISWA</th>
                            <th>KELAS</th>
                            <th>JURUSAN</th>
                            <th>PELANGGARAN</th>
                            <th>POIN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="kasusModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="hideModal()">&times;</span>
            <h3 id="modalTitle" style="color: #0d47a1; border-bottom: 2px solid #ccc; padding-bottom: 10px;">Tambah Kasus Baru</h3>
            <form id="kasusForm">
                <input type="hidden" id="kasusId">
                <input type="hidden" id="siswaNama" data-siswa-id="" data-siswa-nama="">

                <label for="nama">Nama Siswa:</label>
                <select id="nama" required onchange="updateKelasJurusan()">
                </select>

                <label for="pelanggaran">Pelanggaran:</label>
                <input type="text" id="pelanggaran" required>

                <label for="poin">Poin (Angka Pelanggaran):</label>
                <input type="number" id="poin" required min="0" step="1">

                <button type="submit" class="save-button">Simpan Data</button>
            </form>
        </div>
    </div>

    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="hideDetailModal()">&times;</span>
            <h3 style="color: #0d47a1; border-bottom: 2px solid #ccc; padding-bottom: 10px;">Riwayat Pelanggaran: <span id="detailSiswaName"></span></h3>

            <ul id="pelanggaranList" class="pelanggaran-list">
            </ul>
        </div>
    </div>


    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="hideUserModal()">&times;</span>
            <h3 style="color: #0d47a1; border-bottom: 2px solid #ccc; padding-bottom: 10px;">Edit Data User</h3>
            <form id="userForm">
                <input type="hidden" id="userId">
                <label for="userName">Nama User:</label>
                <input type="text" id="userName" required>
                <label for="userEmail">Email:</label>
                <input type="email" id="userEmail" required disabled style="background-color: #eee;">
                <label for="userRole">Role:</label>
                <select id="userRole" required>
                    <option value="siswa">Siswa</option>
                    <option value="guru_bk">Guru BK</option>
                    <option value="admin">Admin</option>
                    <option value="wali_kelas">Wali Kelas</option>
                </select>
                <button type="submit" class="save-button">Simpan Perubahan User</button>
            </form>
        </div>
    </div>


    <script>
        // CSRF Token untuk AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        // Data Siswa akan diambil dari API
        let studentsData = [];
        let casesData = [];
        let nextCaseId = 1;
        let usersData = [];
        let nextUserId = 100;

        // --- FUNGSI API CALLS ---

        /**
         * Fetch semua siswa dari API
         */
        async function fetchSiswa() {
            try {
                const response = await fetch('/api/siswa-list', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                });

                if (!response.ok) throw new Error('Failed to fetch siswa');

                const siswaList = await response.json();

                // Transform API response ke format yang diinginkan
                studentsData = siswaList.map(s => ({
                    id: s.id,
                    nama_lengkap: s.nama_lengkap,
                    email: s.email,
                }));

                populateStudentSelect();
                renderSiswaTable();
            } catch (error) {
                console.error('Error fetching siswa:', error);
                alert('Gagal memuat data siswa');
            }
        }

        /**
         * Fetch semua kasus dari API
         */
        async function fetchKasus() {
            try {
                const response = await fetch('/api/kasus', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                });

                if (!response.ok) throw new Error('Failed to fetch kasus');

                const kasusList = await response.json();

                // Transform API response
                casesData = kasusList.map(k => ({
                    id: k.id,
                    nama_siswa: k.nama_siswa,
                    pelanggaran: k.pelanggaran,
                    poin: k.poin,
                    penanggungJawab: k.penanggungJawab,
                    tanggal: k.tanggal,
                }));

                renderKasusTable();
            } catch (error) {
                console.error('Error fetching kasus:', error);
                alert('Gagal memuat data kasus');
            }
        }

        /**
         * Create kasus via API
         */
        async function submitKasus(formData) {
            try {
                const endpoint = formData.kasusId ? `/api/kasus/${formData.kasusId}` : '/api/kasus';
                const method = formData.kasusId ? 'PUT' : 'POST';

                const response = await fetch(endpoint, {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        siswa_id: formData.siswaId,
                        pelanggaran: formData.pelanggaran,
                        poin: formData.poin,
                        catatan: formData.catatan,
                    }),
                });

                if (!response.ok) {
                    // Try to parse JSON error, but fall back to text (HTML) if server returned an error page
                    const text = await response.text();
                    try {
                        const err = JSON.parse(text);
                        throw new Error(err.error || err.message || 'Failed to save kasus');
                    } catch (e) {
                        // Not JSON — likely an HTML error page. Throw summarized text.
                        const plain = text.replace(/<[^>]+>/g, '').trim();
                        throw new Error(plain ? plain.substring(0, 300) : 'Server error');
                    }
                }

                let result;
                try {
                    result = await response.json();
                } catch (e) {
                    // If parsing fails but response was ok, at least try to read text
                    const txt = await response.text();
                    throw new Error(txt ? txt.substring(0, 300) : 'Invalid server response');
                }
                console.log(result.message);

                // Refresh data
                await fetchKasus();
                hideModal();

                return true;
            } catch (error) {
                console.error('Error submitting kasus:', error);
                alert('Error: ' + error.message);
                return false;
            }
        }

        /**
         * Delete kasus via API
         */
        async function deleteKasusApi(kasusId) {
            if (!window.confirm('Yakin ingin menghapus kasus ini?')) return;

            try {
                const response = await fetch(`/api/kasus/${kasusId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                });

                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.error || 'Failed to delete kasus');
                }

                console.log('Kasus berhasil dihapus!');
                await fetchKasus();
            } catch (error) {
                console.error('Error deleting kasus:', error);
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

            if (sectionId === 'all-users') {
                console.log('Loading all users...');
                renderUserTable();
                console.log(usersData)
            }
        }

        // --- FUNGSI MODAL DETAIL PELANGGARAN ---

        function showDetailModal(studentName) {
            document.getElementById('detailSiswaName').textContent = studentName;
            const pelanggaranList = document.getElementById('pelanggaranList');
            pelanggaranList.innerHTML = '';

            const studentCases = casesData
                .filter(k => k.nama_siswa === studentName)
                .sort((a, b) => new Date(b.tanggal) - new Date(a.tanggal));

            if (studentCases.length === 0) {
                pelanggaranList.innerHTML = '<li>Tidak ada riwayat pelanggaran tercatat.</li>';
            } else {
                studentCases.forEach(kasus => {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `
                        <div>
                            [${kasus.tanggal || 'Tanggal N/A'}] ${kasus.pelanggaran} <br>
                            <small>Oleh: ${kasus.penanggungJawab}</small>
                        </div>
                        <strong>-${kasus.poin} Poin</strong>
                    `;
                    pelanggaranList.appendChild(listItem);
                });
            }

            document.getElementById('detailModal').style.display = 'block';
        }

        function hideDetailModal() {
            document.getElementById('detailModal').style.display = 'none';
        }

        /** Render Tabel Total Poin Siswa */
        function renderSiswaTable() {
            const tableBody = document.getElementById('siswaTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';

            const totalPoinMap = {};
            const lastCaseMap = {};

            casesData.forEach(kasus => {
                totalPoinMap[kasus.nama_siswa] = (totalPoinMap[kasus.nama_siswa] || 0) + kasus.poin;

                if (!lastCaseMap[kasus.nama_siswa] || new Date(kasus.tanggal) > new Date(lastCaseMap[kasus.nama_siswa].date)) {
                    lastCaseMap[kasus.nama_siswa] = kasus;
                }
            });

            const studentStatus = studentsData.map(siswa => {
                const totalPoin = totalPoinMap[siswa.nama_lengkap] || 0;
                return {
                    ...siswa,
                    totalPoin
                };
            }).sort((a, b) => {
                const namaA = (a.nama_lengkap || '').toString().trim();
                const namaB = (b.nama_lengkap || '').toString().trim();
                return namaA.localeCompare(namaB);
            });

            studentStatus.forEach((siswa, index) => {
                const row = tableBody.insertRow();
                const lastCase = lastCaseMap[siswa.nama_lengkap] || {};

                row.insertCell().textContent = index + 1;
                row.insertCell().textContent = siswa.nama_lengkap;
                row.insertCell().textContent = siswa.kelas || '-';
                row.insertCell().textContent = siswa.jurusan || '-';

                const badgeColor = siswa.totalPoin > 100 ? '#b71c1c' : siswa.totalPoin > 50 ? '#e65100' : '#2e7d32';
                row.insertCell().innerHTML = `<span class="poin-badge" style="background-color: ${badgeColor};">${siswa.totalPoin}</span>`;

                const detailCell = row.insertCell();
                detailCell.innerHTML = siswa.totalPoin > 0 ?
                    `<button class="detail-btn" onclick="showDetailModal('${siswa.nama_lengkap}')">Lihat ${siswa.totalPoin} Poin</button>` :
                    'Tidak ada kasus';

                const actionCell = row.insertCell();
                actionCell.classList.add('action-group');
                actionCell.innerHTML = `
                    <button class="siswa-edit-btn" onclick="showAddModal(true, '${siswa.nama_lengkap}', ${siswa.id})">Tambah Kasus</button>
                `;
            });
        }

        /** Render Tabel Riwayat Kasus Siswa */
        function renderKasusTable() {
            const tableBody = document.getElementById('kasusTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';

            const sortedCases = [...casesData].sort((a, b) => new Date(b.tanggal) - new Date(a.tanggal));

            sortedCases.forEach((kasus, index) => {
                const row = tableBody.insertRow();
                row.insertCell().textContent = index + 1;
                row.insertCell().textContent = kasus.nama_siswa;
                row.insertCell().textContent = '-';
                row.insertCell().textContent = '-';
                row.insertCell().textContent = kasus.pelanggaran;
                row.insertCell().innerHTML = `<span class="poin-badge">${kasus.poin}</span>`;

                const actionCell = row.insertCell();
                actionCell.classList.add('action-group');
                actionCell.innerHTML = `
                    <button class="edit-btn" onclick="editKasus(${kasus.id})">Edit</button>
                    <button class="delete-btn" onclick="deleteKasusApi(${kasus.id})">Hapus</button>
                `;
            });

            renderSiswaTable();
        }

        function populateStudentSelect() {
            const selectNama = document.getElementById('nama');
            selectNama.innerHTML = '<option value="">-- Pilih Siswa --</option>';
            studentsData.forEach(siswa => {
                const option = document.createElement('option');
                option.value = siswa.id;
                option.textContent = siswa.nama_lengkap;
                option.dataset.siswaNama = siswa.nama_lengkap;
                selectNama.appendChild(option);
            });
        }

        function updateKelasJurusan() {
            const selectNama = document.getElementById('nama');
            const selectedOption = selectNama.options[selectNama.selectedIndex];

            // Simpan siswa_id ke input hidden
            document.getElementById('siswaNama').dataset.siswaNama = selectedOption.dataset.siswaNama;
            document.getElementById('siswaNama').dataset.siswaId = selectedOption.value;
        }

        function showAddModal(isQuickAdd = false, studentName = '', siswaId = null) {
            document.getElementById('modalTitle').textContent = 'Tambah Kasus Baru';
            document.getElementById('kasusId').value = '';
            document.getElementById('kasusForm').reset();

            const selectNama = document.getElementById('nama');
            selectNama.disabled = false;

            if (isQuickAdd && studentName && siswaId) {
                selectNama.value = siswaId;
                selectNama.disabled = true;
                document.getElementById('siswaNama').dataset.siswaId = siswaId;
                document.getElementById('siswaNama').dataset.siswaNama = studentName;
            }
            document.getElementById('kasusModal').style.display = 'block';
            // Fokuskan input poin agar pengguna bisa langsung mengetik poin
            setTimeout(() => {
                const poinInput = document.getElementById('poin');
                if (poinInput) poinInput.focus();
            }, 100);
        }

        function hideModal() {
            document.getElementById('kasusModal').style.display = 'none';
        }

        function editKasus(id) {
            const kasus = casesData.find(k => k.id === id);
            if (!kasus) return;

            document.getElementById('modalTitle').textContent = 'Edit Kasus';
            document.getElementById('kasusId').value = kasus.id;

            const siswaOption = document.querySelector(`#nama option[data-siswa-nama="${kasus.nama_siswa}"]`);
            if (siswaOption) {
                document.getElementById('nama').value = siswaOption.value;
                document.getElementById('siswaNama').dataset.siswaId = siswaOption.value;
            }

            document.getElementById('pelanggaran').value = kasus.pelanggaran;
            document.getElementById('poin').value = kasus.poin;
            document.getElementById('nama').disabled = true;

            document.getElementById('kasusModal').style.display = 'block';
        }

        document.getElementById('kasusForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const siswaId = document.getElementById('nama').value;
            const pelanggaran = document.getElementById('pelanggaran').value;
            const poin = parseInt(document.getElementById('poin').value);
            const kasusId = document.getElementById('kasusId').value;

            if (!siswaId) {
                alert('Silakan pilih siswa');
                return;
            }

            const formData = {
                kasusId: kasusId || null,
                siswaId: parseInt(siswaId),
                pelanggaran,
                poin,
                catatan: '',
            };

            const success = await submitKasus(formData);
            if (success) {
                document.getElementById('nama').disabled = false;
            }
        });

        window.onclick = function(event) {
            if (!event.target.matches('.profile-btn') && !event.target.closest('.profile-btn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        function renderUserTable() {
            const tableBody = document.getElementById('userTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';

            usersData.sort((a, b) => a.id - b.id);

            usersData.forEach((user, index) => {
                const row = tableBody.insertRow();
                row.insertCell().textContent = user.id;
                row.insertCell().textContent = user.name;
                row.insertCell().textContent = user.email;
                row.insertCell().textContent = user.role.toUpperCase();

                const actionCell = row.insertCell();
                actionCell.classList.add('action-group');
                actionCell.innerHTML = `
                    <button class="user-action-btn" onclick="editUser(${user.id})">Edit Role</button>
                    <button class="delete-btn" onclick="deleteUser(${user.id})">Hapus</button>
                `;
            });
        }

        function editUser(id) {
            const user = usersData.find(u => u.id === id);
            if (!user) return;

            document.getElementById('userId').value = user.id;
            document.getElementById('userName').value = user.name;
            document.getElementById('userEmail').value = user.email;
            document.getElementById('userRole').value = user.role;

            document.getElementById('userModal').style.display = 'block';
        }

        function hideUserModal() {
            document.getElementById('userModal').style.display = 'none';
        }

        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const id = parseInt(document.getElementById('userId').value);
            const name = document.getElementById('userName').value;
            const role = document.getElementById('userRole').value;

            const index = usersData.findIndex(u => u.id === id);
            if (index !== -1) {
                usersData[index].name = name;
                usersData[index].role = role;
                console.log(`User ID ${id} berhasil diperbarui!`);
            }

            renderUserTable();
            hideUserModal();
        });

        function deleteUser(id) {
            if (window.confirm('Yakin ingin menghapus user ini?')) {
                usersData = usersData.filter(u => u.id !== id);
                renderUserTable();
                console.log('User berhasil dihapus!');
            }
        }

        // Inisialisasi saat halaman dimuat
        window.onload = async function() {
            await fetchSiswa();
            await fetchKasus();
        };
    </script>
</body>

</html>