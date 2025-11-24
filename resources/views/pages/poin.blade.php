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
            <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">POIN PELANGGARAN SAYA</h1>

            @php
            $user = Auth::user();
            $siswa = $user ? $user->siswa : null;
            @endphp

            @if(! $user)
            <div class="text-center text-red-600">Silakan login untuk melihat poin Anda.</div>
            @elseif(! $siswa)
            <div class="text-center text-yellow-600">Tidak ditemukan data siswa terkait dengan akun Anda. Mohon hubungi admin.</div>
            @else
            @php
            $cases = $siswa->kasus()->with('pelanggaran')->get();
            $totalPoin = $siswa->getTotalPoin();
            @endphp

            <div class="mb-4 text-center">
                <p class="text-lg font-medium text-blue-700">Nama: {{ $siswa->nama_lengkap ?? $user->name }}</p>
                <p class="text-sm text-gray-600">NIS: {{ $siswa->nis ?? '-' }}</p>
                <p class="text-2xl font-bold text-blue-800 mt-2">Total Poin: {{ $totalPoin }}</p>
            </div>

            <div class="overflow-x-auto rounded-lg shadow-md">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-blue-600 text-white uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Hari/Tanggal</th>
                            <th class="py-3 px-6 text-left">Keterangan Pelanggaran</th>
                            <th class="py-3 px-6 text-left">Poin</th>
                            <th class="py-3 px-6 text-left">Paraf Guru Piket</th>
                            @if(Auth::check() && Auth::user()->hasRole('admin'))
                            <th class="py-3 px-6 text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        @forelse($cases as $index => $kasus)
                        <tr class="border-b border-gray-200 hover:bg-blue-50 {{ $index % 2 == 1 ? 'bg-blue-100' : 'bg-blue-50' }}">
                            <td class="py-3 px-6 text-left">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 text-left">{{ optional($kasus->tanggal)->format('d-m-Y') ?? ($kasus->created_at ? $kasus->created_at->format('d-m-Y') : '-') }}</td>
                            <td class="py-3 px-6 text-left">{{ $kasus->pelanggaran->nama_pelanggaran ?? $kasus->catatan ?? '-' }}</td>
                            <td class="py-3 px-6 text-left">{{ $kasus->pelanggaran->jumlah_poin ?? '-' }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="bg-blue-300 w-12 h-6 rounded-md mx-auto"></div>
                            </td>
                            @if(Auth::check() && Auth::user()->hasRole('admin'))
                            <td class="py-3 px-6 text-center">
                                <a href="#" class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition-colors">Edit</a>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-gray-600">Belum ada pelanggaran tercatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</body>

</html>