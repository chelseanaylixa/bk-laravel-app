<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Poin Pelanggaran</title>
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
            <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">DAFTAR POIN PELANGGARAN SISWA</h1>
            <h2 class="text-xl font-semibold text-blue-700 mb-6 text-center">Kelas: XII RPL</h2>

            <div class="overflow-x-auto rounded-lg shadow-md">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-blue-600 text-white uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Hari/Tanggal</th>
                            <th class="py-3 px-6 text-left">Nama Siswa</th>
                            <th class="py-3 px-6 text-left">Kelas</th>
                            <th class="py-3 px-6 text-left">Keterangan Pelanggaran</th>
                            <th class="py-3 px-6 text-left">Poin</th>
                            <th class="py-3 px-6 text-left">Paraf Guru Piket</th>
                            @if(Auth::check() && Auth::user()->hasRole('admin'))
                                <th class="py-3 px-6 text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        @php
                            $students = [
                                "ACHMAD DEVANI RIZQY PRATAM", "AFRIZAL DANI FERDIANSYAH", "AHMAD ZAKY FAZA", "ANDHI LUKMAN SYAH TIAHION",
                                "BRYAN ANDRIY SHEVCENKO", "CATHERINE ABIGAIL APRILLIA CA", "CHELSEA NAYLIKA AZKA", "DAFFA MAULANA WILAYA",
                                "DENICO TUESDY DESMANA", "DILAN ALAUDIN AMRU", "DIMAS SATRYA IRAWAN", "FADHIL SURYA BUANA",
                                "FAIS FAISHAL HAKIM", "FAREL DWI NUGROHO", "FARDAN HABIBI", "FATCHUR ROCHMAN",
                                "GALANG ARIVIANTO", "HANIFA MAULITA ZAHRA SAFFU", "KENZA EREND PUTRA TAMA", "KHOFIFI AKBAR INDRATAMA",
                                "LUBNA AQUILA SALSABIL", "M. AZRIEL ANHAR", "MARCHELIN EKA FRIANTISA", "MAULANA RIDHO RAMADHAN",
                                "MOCH. DICKY KURNIAWAN", "MOCHAMMAD ALIF RIZKY FADH", "MOCHAMMAD FAJRI HARIANTO", "MOCHAMMAD VALLEN NUR RIZ",
                                "MOH. WIJAYA ANDIKA SAPUTRA", "MUHAMAD FATHUL HADI", "MUHAMMAD FAIRUZ ZAIDAN", "MUHAMMAD IDRIS",
                                "MUHAMMAD MIKAIL KAROMAT", "MUHAMMAD RAFIUDDIN AL-A", "NASRULLAH AL AMIN", "NOVAN WAHYU HIDAYAT",
                                "NUR AVIVAH MAULID DIAH", "QODAMA MAULANA YUSUF", "RASSYA RAJA ISLAMI NOVEANSY", "RAYHAN ALIF PRATAMA",
                                "RENDI SATRIA NUGROHO WICA", "RESTU CANDRA NOVIANTO", "RONI KURNIASANDY", "SATRYA PRAMUDYA ANANDITA"
                            ];

                            // Dummy data untuk contoh
                            $violations = [
                                ["date" => "13-09-2025", "name" => "CHELSEA NAYLIKA AZKA", "violation" => "Terlambat datang", "points" => 5],
                                ["date" => "12-09-2025", "name" => "BRYAN ANDRIY SHEVCENKO", "violation" => "Tidak mengerjakan PR", "points" => 10],
                                ["date" => "11-09-2025", "name" => "DAFFA MAULANA WILAYA", "violation" => "Tidak memakai atribut lengkap", "points" => 5],
                            ];
                        @endphp

                        @foreach($students as $index => $student)
                        <tr class="border-b border-gray-200 hover:bg-blue-50 {{ $index % 2 == 1 ? 'bg-blue-100' : 'bg-blue-50' }}">
                            <td class="py-3 px-6 text-left">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 text-left">
                                @foreach($violations as $violation)
                                    @if($violation['name'] === $student)
                                        <p>{{ $violation['date'] }}</p>
                                    @endif
                                @endforeach
                            </td>
                            <td class="py-3 px-6 text-left">{{ $student }}</td>
                            <td class="py-3 px-6 text-left">XII RPL</td>
                            <td class="py-3 px-6 text-left">
                                @foreach($violations as $violation)
                                    @if($violation['name'] === $student)
                                        <p>{{ $violation['violation'] }}</p>
                                    @endif
                                @endforeach
                            </td>
                            <td class="py-3 px-6 text-left">
                                @foreach($violations as $violation)
                                    @if($violation['name'] === $student)
                                        <p>{{ $violation['points'] }}</p>
                                    @endif
                                @endforeach
                            </td>
                            <td class="py-3 px-6 text-center">
                                @foreach($violations as $violation)
                                    @if($violation['name'] === $student)
                                        <div class="bg-blue-300 w-12 h-6 rounded-md mx-auto"></div>
                                    @endif
                                @endforeach
                            </td>
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