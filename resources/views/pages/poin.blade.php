<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poin Saya - SMK Antartika 1 Sidoarjo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            color: #0d1a40;
            min-height: 100vh;
            padding: 0;
            margin: 0;
        }

        .header {
            background: linear-gradient(to right, #003366, #004aad);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 0;
            margin-bottom: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            width: 100%;
            margin-left: -20px;
            margin-right: -20px;
            padding-left: 50px;
            padding-right: 50px;
            width: calc(100% + 40px);
            box-sizing: border-box;
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
            padding: 40px 20px 20px 20px;
        }

        .student-info {
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
        }

        .student-info p {
            margin: 8px 0;
            font-size: 16px;
        }

        .student-name {
            font-size: 18px;
            font-weight: 700;
            color: #003366;
        }

        .student-nis {
            font-size: 14px;
            color: #666;
        }

        .table-wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .table-container {
            width: 100%;
            min-width: 100%;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead {
            background: #003366;
            color: white;
        }

        .data-table th {
            padding: 16px;
            text-align: center;
            font-weight: 600;
            font-size: 13px;
            white-space: nowrap;
            flex: 1;
        }

        .data-table th:nth-child(1) {
            width: 8%;
            min-width: 50px;
        }

        .data-table th:nth-child(2) {
            width: 20%;
            min-width: 120px;
        }

        .data-table th:nth-child(3) {
            width: 40%;
            min-width: 200px;
        }

        .data-table th:nth-child(4) {
            width: 12%;
            min-width: 60px;
        }

        .data-table th:nth-child(5) {
            width: 25%;
            min-width: 150px;
        }

        .data-table th:nth-child(6) {
            width: 15%;
            min-width: 120px;
        }

        .data-table td {
            padding: 14px 12px;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
            font-size: 13px;
        }

        .data-table td:nth-child(1) {
            width: 8%;
            min-width: 50px;
        }

        .data-table td:nth-child(2) {
            width: 20%;
            min-width: 120px;
        }

        .data-table td:nth-child(3) {
            width: 40%;
            min-width: 200px;
        }

        .data-table td:nth-child(4) {
            width: 12%;
            min-width: 60px;
        }

        .data-table td:nth-child(5) {
            width: 25%;
            min-width: 150px;
        }

        .data-table td:nth-child(6) {
            width: 15%;
            min-width: 120px;
        }

        .catatan-box {
            background: #f0f7ff;
            padding: 10px;
            border-radius: 4px;
            text-align: left;
            font-size: 12px;
            color: #0d1a40;
            min-height: 40px;
            display: flex;
            align-items: center;
            word-wrap: break-word;
        }

        .catatan-box.empty {
            color: #999;
            font-style: italic;
        }

        .paraf-box {
            width: 70px;
            height: 40px;
            border: 1px solid #999;
            display: inline-block;
            background: white;
            margin: 0 auto;
        }

        .data-table tbody tr:hover {
            background: #f9f9f9;
        }

        .empty-state {
            padding: 40px 20px;
            color: #999;
            font-size: 16px;
        }

        /* Button Detail */
        .btn-detail {
            background: linear-gradient(to right, #004aad, #0066cc);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-detail:hover {
            background: linear-gradient(to right, #003366, #004aad);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 51, 102, 0.3);
        }

        /* Modal Styling */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            overflow-y: auto;
            padding: 20px;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            max-width: 900px;
            margin: 30px auto;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.3s ease-out;
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

        .modal-header {
            background: linear-gradient(to right, #003366, #004aad);
            color: white;
            padding: 20px 30px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 20px;
        }

        .close-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            font-size: 28px;
            cursor: pointer;
            padding: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .modal-body {
            padding: 30px;
        }

        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid #e0e0e0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-radius: 0 0 12px 12px;
        }

        .btn-close {
            background: #e0e0e0;
            color: #333;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-close:hover {
            background: #d0d0d0;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
            }

            .student-info {
                padding: 20px;
            }

            .data-table th,
            .data-table td {
                padding: 12px 8px;
                font-size: 13px;
            }

            .modal-content {
                margin: 20px;
            }

            .btn-detail {
                padding: 6px 12px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <button class="back-btn" onclick="history.back()">
            <i class="fas fa-arrow-left"></i> Kembali
        </button>
        <h1 style="flex: 1; margin: 0;">
            @php
            $userRole = Auth::user()?->role;
            $isWaliRole = in_array($userRole, ['wali_kelas', 'wali_murid']);
            @endphp
            @if($isWaliRole)
            📊 Semua Poin Siswa
            @else
            📊 Poin Saya
            @endif
        </h1>
        <div style="width: 100px;"></div>
    </div>

    <div class="content-wrapper">
        @php
        $user = Auth::user();
        $userRole = $user ? $user->role : null;
        $siswa = $user ? $user->siswa : null;
        $isWaliRole = in_array($userRole, ['wali_kelas', 'wali_murid']);
        @endphp

        @if(! $user)
        <div class="student-info">
            <p style="color: #d32f2f;">Silakan login untuk melihat poin Anda.</p>
        </div>

        {{-- VIEW UNTUK WALI KELAS / WALI MURID --}}
        @elseif($isWaliRole)
        @php
        $allSiswa = \App\Models\Siswa::with('kasus.pelanggaran')->get()->filter(function($s) {
        return $s->kasus()->count() > 0;
        })->values();
        @endphp

        <div class="student-info">
            <p class="student-name">📊 Data Poin Semua Siswa</p>
            <p style="color: #666; font-size: 14px;">Menampilkan poin semua siswa di sekolah</p>
        </div>

        <div class="table-wrapper">
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA SISWA</th>
                            <th>NIS</th>
                            <th>TOTAL POIN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allSiswa as $index => $s)
                        @php
                        $totalPoin = $s->getTotalPoin();
                        $caseCount = $s->kasus()->count();
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $s->nama_lengkap ?? '-' }}</strong></td>
                            <td>{{ $s->nis ?? '-' }}</td>
                            <td><strong style="color: #d32f2f; font-size: 16px;">{{ $totalPoin }}</strong></td>
                            <td style="text-align: center;">
                                <button class="btn-detail" data-siswa-id="{{ $s->id }}" data-siswa-nama="{{ $s->nama_lengkap }}" data-siswa-nis="{{ $s->nis }}" data-total-poin="{{ $totalPoin }}" onclick="showDetailModalByData(this)">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-state">Tidak ada data pelanggaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MODAL DETAIL KASUS SISWA --}}
        <div id="detailModal" class="modal" style="display: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="modalTitle">Detail Poin Siswa</h2>
                    <button class="close-btn" onclick="closeDetailModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="studentInfo" style="margin-bottom: 20px; padding: 15px; background: #f0f7ff; border-radius: 8px;">
                        <p><strong>Nama:</strong> <span id="studentName"></span></p>
                        <p><strong>NIS:</strong> <span id="studentNis"></span></p>
                        <p><strong>Total Poin:</strong> <span id="totalPoinDisplay" style="color: #d32f2f; font-weight: bold;"></span></p>
                    </div>
                    <table class="data-table" id="detailTable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>HARI/TANGGAL</th>
                                <th>KASUS</th>
                                <th>POIN</th>
                            </tr>
                        </thead>
                        <tbody id="detailTableBody">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn-close" onclick="closeDetailModal()">Tutup</button>
                </div>
            </div>
        </div>

        {{-- VIEW UNTUK SISWA --}}
        @elseif(! $siswa)
        <div class="student-info">
            <p style="color: #004aad;">Tidak ditemukan data siswa terkait dengan akun Anda. Mohon hubungi admin.</p>
        </div>

        @else
        @php
        $cases = $siswa->kasus()->with('pelanggaran')->get();
        $totalPoin = $siswa->getTotalPoin();
        @endphp

        <div class="student-info">
            <p class="student-name">{{ $siswa->nama_lengkap ?? $user->name }}</p>
            <p class="student-nis">NIS: {{ $siswa->nis ?? '-' }}</p>
        </div>

        <div class="table-wrapper">
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>HARI/TANGGAL</th>
                            <th>KASUS</th>
                            <th>POIN</th>
                            <th>PARAF GURU</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cases as $index => $kasus)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ optional($kasus->tanggal)->format('d-m-Y') ?? ($kasus->created_at ? $kasus->created_at->format('d-m-Y') : '-') }}</td>
                            <td>{{ $kasus->pelanggaran->nama_pelanggaran ?? '-' }}</td>
                            <td><strong>{{ $kasus->pelanggaran->jumlah_poin ?? 0 }}</strong></td>
                            <td style="text-align: center;">
                                <div class="paraf-box"></div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-state">Belum ada pelanggaran tercatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    <script>
        // Fungsi untuk menampilkan modal detail dari data attributes
        function showDetailModalByData(button) {
            const siswaId = button.getAttribute('data-siswa-id');
            const siswaNama = button.getAttribute('data-siswa-nama');
            const siswanis = button.getAttribute('data-siswa-nis');
            const totalPoin = button.getAttribute('data-total-poin');

            showDetailModal(siswaId, siswaNama, siswanis, totalPoin);
        }

        // Fungsi untuk menampilkan modal detail
        function showDetailModal(siswaId, siswaNama, siswanis, totalPoin) {
            // Set informasi siswa
            document.getElementById('studentName').textContent = siswaNama;
            document.getElementById('studentNis').textContent = siswanis;
            document.getElementById('totalPoinDisplay').textContent = totalPoin;
            document.getElementById('modalTitle').textContent = 'Detail Poin - ' + siswaNama;

            // Fetch data kasus siswa
            fetch(`/api/siswa/${siswaId}/kasus`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('detailTableBody');
                    tbody.innerHTML = '';

                    if (data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="4" class="empty-state">Tidak ada kasus tercatat</td></tr>';
                    } else {
                        data.forEach((kasus, index) => {
                            const tanggal = new Date(kasus.tanggal || kasus.created_at).toLocaleDateString('id-ID', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            }).replace(/\//g, '-');

                            const row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${tanggal}</td>
                                    <td>${kasus.pelanggaran?.nama_pelanggaran || '-'}</td>
                                    <td><strong style="color: #d32f2f;">${kasus.pelanggaran?.jumlah_poin || 0}</strong></td>
                                </tr>
                            `;
                            tbody.innerHTML += row;
                        });
                    }

                    // Tampilkan modal
                    document.getElementById('detailModal').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat data kasus');
                });
        }

        // Fungsi untuk menutup modal
        function closeDetailModal() {
            document.getElementById('detailModal').style.display = 'none';
        }

        // Tutup modal saat klik di luar modal
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Tutup modal saat tekan ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDetailModal();
            }
        });
    </script>
</body>

</html>