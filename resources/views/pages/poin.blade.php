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
            padding: 20px;
        }

        .header {
            background: linear-gradient(to right, #003366, #004aad);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 12px;
            margin-bottom: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
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
            width: 20%;
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
            width: 20%;
            min-width: 120px;
        }

        .paraf-box {
            width: 50px;
            height: 30px;
            border: 1px solid #ccc;
            display: inline-block;
            background: #f9f9f9;
        }

        .data-table tbody tr:hover {
            background: #f9f9f9;
        }

        .empty-state {
            padding: 40px 20px;
            color: #999;
            font-size: 16px;
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
        }
    </style>
</head>

<body>
    <div class="header">
        <button class="back-btn" onclick="history.back()">
            <i class="fas fa-arrow-left"></i> Kembali
        </button>
        <h1 style="flex: 1; margin: 0;">📊 Poin Saya</h1>
        <div style="width: 100px;"></div>
    </div>

    <div class="content-wrapper">
        @php
        $user = Auth::user();
        $siswa = $user ? $user->siswa : null;
        @endphp

        @if(! $user)
        <div class="student-info">
            <p style="color: #d32f2f;">Silakan login untuk melihat poin Anda.</p>
        </div>
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
                            <th>PELANGGARAN</th>
                            <th>POIN</th>
                            <th>PARAF GURU</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cases as $index => $kasus)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ optional($kasus->tanggal)->format('d-m-Y') ?? ($kasus->created_at ? $kasus->created_at->format('d-m-Y') : '-') }}</td>
                            <td>{{ $kasus->pelanggaran->nama_pelanggaran ?? $kasus->catatan ?? '-' }}</td>
                            <td><strong>{{ $kasus->pelanggaran->jumlah_poin ?? 0 }}</strong></td>
                            <td>
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
</body>

</html>