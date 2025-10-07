<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kasus Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4 md:p-8">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold text-blue-800 mb-2 text-center">DAFTAR KASUS SISWA</h1>
            <h2 class="text-xl font-semibold text-blue-700 mb-6 text-center">SMK ANTARTIKA 1 SIDOARJO</h2>

            <div class="overflow-x-auto rounded-lg shadow-md">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-blue-600 text-white uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nama Siswa</th>
                            <th class="py-3 px-6 text-left">Kelas</th>
                            <th class="py-3 px-6 text-left">Kasus</th>
                            <th class="py-3 px-6 text-left">Proses Konseling / Penanganan</th>
                            @if(Auth::check() && Auth::user()->hasRole('admin'))
                                <th class="py-3 px-6 text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        @php
                            $kasus = [
                                [
                                    "nama" => "Daffa Maulana Wilaya",
                                    "kelas" => "XII RPL",
                                    "kasus" => "Kecanduan bermain game online hingga mengganggu prestasi akademik. Sering membolos dan berbohong kepada orang tua.",
                                    "penanganan" => "Melakukan pendekatan Konseling Realitas dan Konseling Behaviour. Membuat kesepakatan dengan siswa untuk membatasi waktu bermain game dan menyusun jadwal belajar. Melibatkan orang tua untuk memantau perilaku siswa di rumah.",
                                ],
                                [
                                    "nama" => "Chelsea Naylika Azka",
                                    "kelas" => "XII RPL",
                                    "kasus" => "Perundungan (bullying) verbal terhadap teman sekelasnya. Menyebabkan lingkungan belajar menjadi tidak nyaman dan beberapa siswa merasa tertekan.",
                                    "penanganan" => "Melakukan konseling individu dan kelompok dengan melibatkan siswa yang menjadi korban. Menerapkan sanksi sesuai tata tertib sekolah. Mengedukasi siswa tentang empati dan dampak dari perundungan.",
                                ],
                                [
                                    "nama" => "Bryan Andriy Shevcenko",
                                    "kelas" => "XII RPL",
                                    "kasus" => "Kurang motivasi belajar dan sering tidak menyelesaikan tugas. Berdampak pada nilai yang rendah di beberapa mata pelajaran.",
                                    "penanganan" => "Melakukan konseling motivasi untuk menggali minat dan bakat siswa. Membuat target belajar yang realistis dan memberikan dukungan akademis. Mengajak guru mata pelajaran untuk berkolaborasi dalam memberikan bimbingan.",
                                ],
                            ];
                        @endphp
                        
                        @foreach($kasus as $index => $data)
                        <tr class="border-b border-gray-200 hover:bg-blue-50 {{ $index % 2 == 1 ? 'bg-blue-100' : 'bg-blue-50' }}">
                            <td class="py-3 px-6 text-left">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 text-left font-medium">{{ $data['nama'] }}</td>
                            <td class="py-3 px-6 text-left">{{ $data['kelas'] }}</td>
                            <td class="py-3 px-6 text-left">{{ $data['kasus'] }}</td>
                            <td class="py-3 px-6 text-left">{{ $data['penanganan'] }}</td>
                            @if(Auth::check() && Auth::user()->hasRole('admin'))
                                <td class="py-3 px-6 text-center">
                                    <button class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition-colors">Edit</button>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>