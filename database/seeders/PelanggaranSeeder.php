<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelanggaranSeeder extends Seeder
{
    public function run(): void
    {
        $pelanggaran = [
            ['nama_pelanggaran' => 'Datang terlambat', 'kategori' => 'Kedisiplinan', 'deskripsi' => 'Siswa datang terlambat ke sekolah', 'jumlah_poin' => 5],
            ['nama_pelanggaran' => 'Bolos sekolah', 'kategori' => 'Kehadiran', 'deskripsi' => 'Siswa tidak hadir tanpa izin', 'jumlah_poin' => 15],
            ['nama_pelanggaran' => 'Tidak mengerjakan PR', 'kategori' => 'Akademik', 'deskripsi' => 'Siswa tidak mengerjakan pekerjaan rumah', 'jumlah_poin' => 10],
            ['nama_pelanggaran' => 'Berpakaian tidak rapi', 'kategori' => 'Penampilan', 'deskripsi' => 'Siswa berpakaian tidak sesuai aturan', 'jumlah_poin' => 5],
            ['nama_pelanggaran' => 'Merokok', 'kategori' => 'Perilaku', 'deskripsi' => 'Siswa merokok di area sekolah', 'jumlah_poin' => 25],
            ['nama_pelanggaran' => 'Perkelahian', 'kategori' => 'Perilaku', 'deskripsi' => 'Siswa terlibat perkelahian', 'jumlah_poin' => 30],
            ['nama_pelanggaran' => 'Menggunakan HP di kelas', 'kategori' => 'Disiplin', 'deskripsi' => 'Siswa menggunakan ponsel saat pembelajaran', 'jumlah_poin' => 8],
            ['nama_pelanggaran' => 'Membully teman', 'kategori' => 'Perilaku', 'deskripsi' => 'Siswa membully atau mengganggu teman', 'jumlah_poin' => 20],
        ];

        foreach ($pelanggaran as $item) {
            DB::table('pelanggaran')->insert($item);
        }
    }
}
