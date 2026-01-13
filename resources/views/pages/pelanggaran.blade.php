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

    <nav class="text-white px-6 py-4 shadow-md mb-8 sticky top-0 z-50" style="background: linear-gradient(to right, #003366, #004aad);">
        <div class="container mx-auto flex justify-start items-center gap-4 max-w-5xl">
            <button
                class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white border-none px-4 py-2 rounded-md cursor-pointer transition-all duration-300 flex items-center gap-2"
                onclick="history.back()"
                aria-label="Kembali ke halaman sebelumnya">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>
            <div class="font-bold text-lg flex items-center gap-2">
                <i class="fa-solid fa-book-open"></i> Pelanggaran
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 pb-10 max-w-5xl flex-1">

        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            <div class="p-5" style="background: linear-gradient(to right, #003366, #004aad);">
                <h2 class="text-white text-xl font-bold text-center uppercase tracking-wide">DAFTAR PELANGGARAN & SANKSI</h2>
            </div>

            <!-- Filter Kategori Section -->
            <div class="p-6 border-b border-gray-200 bg-gray-50">
                <label for="kategoriFilter" class="block text-sm font-semibold text-gray-700 mb-3">
                    <i class="fas fa-filter mr-2"></i>Pilih Kategori:
                </label>
                <select id="kategoriFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" onchange="filterByCategory()">
                    <option value="">-- Tampilkan Semua Kategori --</option>
                    @php
                    $kategoris = $tataTertibs->pluck('kategori')->unique()->sort();
                    @endphp
                    @foreach($kategoris as $kategori)
                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Card-based Layout -->
            <div class="p-6" id="card-container">
                {{-- LOOPING DATA DARI CONTROLLER --}}
                @foreach($tataTertibs as $aturan)
                <div class="pelanggaran-card mb-4 p-5 border-l-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 bg-white pelanggaran-row"
                    data-kategori="{{ $aturan->kategori }}"
                    style="border-left-color: #004aad;">

                    <div class="flex flex-col gap-3">
                        <!-- Kategori Badge -->
                        <div class="flex items-start justify-between gap-3">
                            <span class="inline-block px-3 py-1 text-xs font-bold text-white rounded-full"
                                style="background: linear-gradient(to right, #003366, #004aad);">
                                {{ $aturan->kategori }}
                            </span>
                        </div>

                        <!-- Jenis Pelanggaran -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-800 mb-1">Jenis Pelanggaran:</h3>
                            <p class="text-sm text-gray-700">{{ $aturan->jenis_pelanggaran }}</p>
                        </div>

                        <!-- Sanksi / Penanganan -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-800 mb-1">Sanksi / Penanganan:</h3>
                            <p class="text-sm text-gray-700">{{ $aturan->sanksi }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- END LOOPING --}}
            </div>

            <div class="bg-gray-100 p-4 text-center text-xs text-gray-500 border-t border-gray-200">
                * Peraturan ini mengikat seluruh siswa SMK Antartika 1 Sidoarjo.
            </div>

        </div>

    </div>

    <script>
        function filterByCategory() {
            const selectedKategori = document.getElementById('kategoriFilter').value;
            const cards = document.querySelectorAll('.pelanggaran-row');

            cards.forEach(card => {
                const cardKategori = card.getAttribute('data-kategori');

                if (selectedKategori === '' || cardKategori === selectedKategori) {
                    card.style.display = 'block';
                    // Tambah animasi fade in
                    card.style.opacity = '0';
                    card.style.animation = 'fadeIn 0.3s ease-in-out forwards';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // CSS untuk animasi
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-5px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>

</body>

</html>