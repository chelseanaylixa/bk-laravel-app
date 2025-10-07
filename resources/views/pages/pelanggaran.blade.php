<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggaran</title>
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
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-5xl mx-auto">
            <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">Tabel Pelanggaran</h1>

            <div class="overflow-x-auto rounded-lg shadow-md">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-blue-600 text-white uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Jenis Pelanggaran</th>
                            <th class="py-3 px-6 text-left">Pelanggaran</th>
                            <th class="py-3 px-6 text-left">Cara Penanganan</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        <tr class="border-b border-gray-200 hover:bg-blue-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-medium">Akademik</td>
                            <td class="py-3 px-6 text-left">Terlambat datang ke sekolah</td>
                            <td class="py-3 px-6 text-left">Sanksi sesuai tata tertib sekolah, penanaman kesadaran disiplin.</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-blue-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-medium">Akademik</td>
                            <td class="py-3 px-6 text-left">Tidak hadir tanpa surat keterangan</td>
                            <td class="py-3 px-6 text-left">Pemberian sanksi dan komunikasi dengan wali murid.</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-blue-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-medium">Akademik</td>
                            <td class="py-3 px-6 text-left">Tidak mengerjakan tugas/PR</td>
                            <td class="py-3 px-6 text-left">Motivasi dan bimbingan dari guru, pemberian tugas tambahan.</td>
                        </tr>

                        <tr class="border-b border-gray-200 bg-blue-100 hover:bg-blue-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-medium">Estetika</td>
                            <td class="py-3 px-6 text-left">Tidak berpakaian seragam sesuai ketentuan</td>
                            <td class="py-3 px-6 text-left">Peringatan lisan, sanksi ringan, dan penegakan kode etik.</td>
                        </tr>
                        <tr class="border-b border-gray-200 bg-blue-100 hover:bg-blue-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-medium">Estetika</td>
                            <td class="py-3 px-6 text-left">Rambut gondrong/tidak rapi</td>
                            <td class="py-3 px-6 text-left">Tindakan pendisiplinan (misalnya, dipotong di sekolah), pemberian contoh keteladanan.</td>
                        </tr>

                        <tr class="border-b border-gray-200 hover:bg-blue-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-medium">Etika</td>
                            <td class="py-3 px-6 text-left">Bersikap tidak sopan terhadap guru/staf</td>
                            <td class="py-3 px-6 text-left">Bimbingan konseling, pemberian sanksi, dan penanaman kesadaran moral.</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-blue-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-medium">Etika</td>
                            <td class="py-3 px-6 text-left">Membawa dan merokok di lingkungan sekolah</td>
                            <td class="py-3 px-6 text-left">Sanksi berat, komunikasi dengan orang tua, dan pembinaan.</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-blue-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-medium">Etika</td>
                            <td class="py-3 px-6 text-left">Melakukan tindakan kriminal</td>
                            <td class="py-3 px-6 text-left">Penanganan sesuai hukum yang berlaku dan kolaborasi dengan pihak berwenang.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>