<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KasusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kasus')->insert([
            [
                'nama_siswa' => 'Budi Santoso',
                'kelas' => 'XII RPL 1',
                'jurusan' => 'Rekayasa Perangkat Lunak',
                'pelanggaran' => 'Terlambat masuk sekolah',
                'poin' => 10,
                'penanggung_jawab' => 'B. Prapti',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_siswa' => 'Siti Aminah',
                'kelas' => 'XI TKJ 2',
                'jurusan' => 'Teknik Komputer Jaringan',
                'pelanggaran' => 'Tidak memakai atribut lengkap',
                'poin' => 15,
                'penanggung_jawab' => 'B. Eka',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_siswa' => 'Andi Wijaya',
                'kelas' => 'XII MM 1',
                'jurusan' => 'Multimedia',
                'pelanggaran' => 'Merokok di sekolah',
                'poin' => 50,
                'penanggung_jawab' => 'B. Prapti',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
