<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Data Kelas dan Pelanggaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 20px;
        }

        .logo h2 {
            font-size: 1.5rem;
        }

        .menu {
            list-style: none;
        }

        .menu-item {
            padding: 15px 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #2563eb;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .header h1 {
            color: #2a5298;
            font-size: 1.8rem;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h2 {
            color: #1e3c72;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .tab {
            padding: 10px 20px;
            background-color: #e0e0e0;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab:hover,
        .tab.active {
            background-color: #2a5298;
            color: white;
        }

        .class-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .class-card {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: white;
            padding: 15px;
            border-radius: 8px;
            width: calc(33.333% - 20px);
            min-width: 250px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .class-card:hover {
            transform: scale(1.03);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .class-card h3 {
            margin-bottom: 10px;
            font-size: 1.3rem;
        }

        .jurusan-list {
            list-style: none;
            margin-top: 10px;
        }

        .jurusan-list li {
            padding: 5px 0;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .jurusan-list li:hover {
            background-color: rgba(255, 255, 255, 0.1);
            padding-left: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #e0e0e0;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            color: #1e3c72;
            cursor: pointer;
        }

        th:hover {
            background-color: #e9ecef;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f5ff;
        }

        td {
            cursor: pointer;
        }

        .violation-examples {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .violation-card {
            background: white;
            border-left: 4px solid #2563eb;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .violation-card:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .violation-card h4 {
            color: #2563eb;
            margin-bottom: 10px;
        }

        .violation-list {
            list-style: none;
        }

        .violation-list li {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .violation-list li:hover {
            background-color: #f0f7ff;
            padding-left: 5px;
        }

        .violation-list li:last-child {
            border-bottom: none;
        }

        .violation-list li i {
            margin-right: 8px;
            color: #2563eb;
        }

        .edit-btn {
            background-color: #4facfe;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s ease;
        }

        .edit-btn:hover {
            background-color: #2a5298;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .close-btn {
            float: right;
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }

        .close-btn:hover {
            color: #333;
        }

        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 15px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 10px;
            }

            .class-card {
                width: 100%;
            }

            .violation-examples {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Data Kelas dan Jurusan</h1>
            <div class="user-info">
            </div>
        </div>

        <!-- Class Information -->
        <div class="card">
            <div class="class-info">
                <div class="class-card" onclick="showNotification('Kelas X dipilih')">
                    <h3>Kelas X</h3>
                    <p>Jurusan:</p>
                    <ul class="jurusan-list">
                        <li onclick="showNotification('TKR dipilih')">TKR (7 kelas: TKR I - TKR VII)</li>
                        <li onclick="showNotification('TPM dipilih')">TPM (5 kelas: TPM I - TPM V)</li>
                        <li onclick="showNotification('RPL dipilih')">RPL (3 kelas)</li>
                        <li onclick="showNotification('TEI dipilih')">TEI (3 kelas)</li>
                        <li onclick="showNotification('TITL dipilih')">TITL (2 kelas)</li>
                    </ul>
                </div>

                <div class="class-card" onclick="showNotification('Kelas XI dipilih')">
                    <h3>Kelas XI</h3>
                    <p>Jurusan:</p>
                    <ul class="jurusan-list">
                        <li onclick="showNotification('TKR dipilih')">TKR (8 kelas: TKR I - TKR VIII)</li>
                        <li onclick="showNotification('TPM dipilih')">TPM (6 kelas: TPM I - TPM VI)</li>
                        <li onclick="showNotification('RPL dipilih')">RPL (3 kelas)</li>
                        <li onclick="showNotification('TEI dipilih')">TEI (3 kelas)</li>
                        <li onclick="showNotification('TITL dipilih')">TITL (2 kelas)</li>
                    </ul>
                </div>

                <div class="class-card" onclick="showNotification('Kelas XII dipilih')">
                    <h3>Kelas XII</h3>
                    <p>Jurusan:</p>
                    <ul class="jurusan-list">
                        <li onclick="showNotification('TKR dipilih')">TKR (6 kelas: TKR I - TKR VI)</li>
                        <li onclick="showNotification('TPM dipilih')">TPM (4 kelas: TPM I - TPM IV)</li>
                        <li onclick="showNotification('RPL dipilih')">RPL (3 kelas)</li>
                        <li onclick="showNotification('TEI dipilih')">TEI (3 kelas)</li>
                        <li onclick="showNotification('TITL dipilih')">TITL (2 kelas)</li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-600">
            <h2 class="text-2xl font-semibold text-blue-800 mb-4">Penjelasan Jurusan</h2>
            <div class="space-y-6">
                <div>
                    <h3 class="text-xl font-bold text-blue-900">Teknik Kendaraan Ringan (TKR)</h3>
                    <p class="text-gray-700">Jurusan ini fokus pada perbaikan dan perawatan mobil. Siswa akan mempelajari tentang mesin, sistem kelistrikan, dan sasis kendaraan ringan.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-blue-900">Rekayasa Perangkat Lunak (RPL)</h3>
                    <p class="text-gray-700">Jurusan ini mengajarkan siswa cara mengembangkan perangkat lunak, mulai dari aplikasi desktop, web, hingga mobile. Kurikulum mencakup pemrograman, basis data, dan desain sistem.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-blue-900">Teknik Permesinan (TPM)</h3>
                    <p class="text-gray-700">Siswa di jurusan ini akan belajar mengoperasikan mesin-mesin industri, membuat komponen mekanik, dan merawat peralatan produksi. Keterampilan yang diajarkan sangat dibutuhkan di dunia manufaktur.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-blue-900">Teknik Listrik (TITL)</h3>
                    <p class="text-gray-700">Jurusan ini mendalami instalasi, perbaikan, dan pemeliharaan sistem kelistrikan. Siswa akan belajar tentang rangkaian listrik, motor listrik, dan sistem tenaga listrik.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-blue-900">Teknik Elektronika Industri (TEI)</h3>
                    <p class="text-gray-700">Jurusan ini menggabungkan elektronika dengan sistem kontrol otomatis. Siswa akan mempelajari cara merancang dan memprogram perangkat elektronika untuk keperluan industri.</p>
                </div>
            </div>
        </div>