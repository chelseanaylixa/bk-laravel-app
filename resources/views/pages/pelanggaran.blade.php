<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggaran & Tata Tertib - SMK Antartika 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <nav class="bg-[#1e3a8a] text-white px-6 py-4 shadow-md mb-8 sticky top-0 z-50">
        <div class="container mx-auto flex justify-start items-center gap-4 max-w-5xl">
            <button
                class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white border-none px-4 py-2 rounded-md cursor-pointer transition-all duration-300 flex items-center gap-2"
                onclick="history.back()"
                aria-label="Kembali ke halaman sebelumnya">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>
            <div class="font-bold text-lg flex items-center gap-2">
                <i class="fa-solid fa-book-open"></i> Tata Tertib Sekolah
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 pb-10 max-w-5xl flex-1">

        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            <div class="bg-[#1e3a8a] p-5">
                <h2 class="text-white text-xl font-bold text-center uppercase tracking-wide">DAFTAR PELANGGARAN & SANKSI</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-800 text-white text-sm uppercase">
                            <th class="py-4 px-6 w-1/5 border-r border-blue-700 text-center">Kategori</th>
                            <th class="py-4 px-6 w-1/3 border-r border-blue-700 text-center">Jenis Pelanggaran</th>
                            <th class="py-4 px-6 w-1/2 text-center">Sanksi / Penanganan</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        {{-- LOOPING DATA DARI CONTROLLER --}}
                        @foreach($tataTertibs as $aturan)
                        <tr class="border-b hover:bg-blue-50 transition">
                            <td class="py-4 px-6 font-bold text-blue-800 border-r border-gray-200 align-middle text-center">{{ $aturan->kategori }}</td>
                            <td class="py-4 px-6 border-r border-gray-200 align-middle">{{ $aturan->jenis_pelanggaran }}</td>
                            <td class="py-4 px-6 align-middle">{{ $aturan->sanksi }}</td>
                        </tr>
                        @endforeach
                        {{-- END LOOPING --}}

                    </tbody>
                </table>
            </div>

            <div class="bg-gray-100 p-4 text-center text-xs text-gray-500 border-t border-gray-200">
                * Peraturan ini mengikat seluruh siswa SMK Antartika 1 Sidoarjo.
            </div>

        </div>

</body>

</html>