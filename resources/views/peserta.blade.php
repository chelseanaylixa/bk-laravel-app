<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <h1 class="text-2xl font-bold mb-4">Daftar Peserta</h1>
                <p class="text-gray-600 mb-6">Berikut daftar nama peserta kelas XII RPL:</p>

                <!-- Tabel peserta -->
                <table class="min-w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Nama Peserta</th>
                            <th class="px-4 py-2 border">Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $peserta = [
                                "ACHMAD DEVANI RIZQY PRATAM",
                                "AFRIZAL DANI FERDIANSYAH",
                                "AHMAD ZAKY FAZA",
                                "ANDHI LUKMAN SYAH TIAHION",
                                "BRYAN ANDRIY SHEVCENKO",
                                "CATHERINE ABIGAIL APRILLIA CA",
                                "CHELSEA NAYLIKA AZKA",
                                "DAFFA MAULANA WILAYA",
                                "DENICO TUESDY DESMANA",
                                "DILAN ALAUDIN AMRU",
                                "DIMAS SATRYA IRAWAN",
                                "FADHIL SURYA BUANA",
                                "FAIS FAISHAL HAKIM",
                                "FAREL DWI NUGROHO",
                                "FARDAN HABIBI",
                                "FATCHUR ROCHMAN",
                                "GALANG ARIVIANTO",
                                "HANIFA MAULITA ZAHRA SAFFU",
                                "KENZA EREND PUTRA TAMA",
                                "KHOFIFI AKBAR INDRATAMA",
                                "LUBNA AQUILA SALSABIL",
                                "M. AZRIEL ANHAR",
                                "MARCHELIN EKA FRIANTISA",
                                "MAULANA RIDHO RAMADHAN",
                                "MOCH. DICKY KURNIAWAN",
                                "MOCHAMMAD ALIF RIZKY FADH",
                                "MOCHAMMAD FAJRI HARIANTO",
                                "MOCHAMMAD VALLEN NUR RIZ",
                                "MOH. WIJAYA ANDIKA SAPUTRA",
                                "MUHAMAD FATHUL HADI",
                                "MUHAMMAD FAIRUZ ZAIDAN",
                                "MUHAMMAD IDRIS",
                                "MUHAMMAD MIKAIL KAROMAT",
                                "MUHAMMAD RAFIUDDIN AL-A",
                                "NASRULLAH AL AMIN",
                                "NOVAN WAHYU HIDAYAT",
                                "NUR AVIVAH MAULID DIAH",
                                "QODAMA MAULANA YUSUF",
                                "RASSYA RAJA ISLAMI NOVEANSY",
                                "RAYHAN ALIF PRATAMA",
                                "RENDI SATRIA NUGROHO WICA",
                                "RESTU CANDRA NOVIANTO",
                                "RONI KURNIASANDY",
                                "SATRYA PRAMUDYA ANANDITA"
                            ];
                        @endphp

                        @foreach($peserta as $index => $nama)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">{{ $index+1 }}</td>
                            <td class="px-4 py-2 border">{{ $nama }}</td>
                            <td class="px-4 py-2 border text-center">XII RPL</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
