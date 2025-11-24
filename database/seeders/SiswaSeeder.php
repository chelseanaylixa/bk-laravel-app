<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswaList = [
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

        foreach ($siswaList as $index => $namaLengkap) {
            // Create user first
            $user = DB::table('users')->insertGetId([
                'name' => $namaLengkap,
                'email' => strtolower(str_replace(' ', '.', $namaLengkap)) . '@siswa.smk.sch.id',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Then create siswa record
            DB::table('siswa')->insert([
                'user_id' => $user,
                'nama_lengkap' => $namaLengkap,
                'nis' => sprintf('NIS%04d', $index + 1),
                'jenis_kelamin' => $index % 2 == 0 ? 'Laki-laki' : 'Perempuan',
                'tanggal_lahir' => now()->subYears(15)->toDateString(),
                'alamat' => 'Jalan Pembangunan No. ' . ($index + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
