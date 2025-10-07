<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerkembanganSiswa;
use Illuminate\Support\Facades\DB;

class PerkembanganSiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Menggunakan Eloquent Model
        PerkembanganSiswa::create([
            'siswa_id' => 2, // id user siswa
            'tanggal' => now(),
            'aspek' => 'Akademik',
            'jenis_perkembangan' => 'Kenaikan Nilai',
            'catatan' => 'Nilai matematika meningkat dari 65 ke 80.',
            'penanggung_jawab' => 'Bu Prapti',
        ]);

        PerkembanganSiswa::create([
            'siswa_id' => 2,
            'tanggal' => now(),
            'aspek' => 'Perilaku',
            'jenis_perkembangan' => 'Disiplin',
            'catatan' => 'Lebih disiplin, tidak terlambat.',
            'penanggung_jawab' => 'Bu Eka',
        ]);

        // Kalau mau pakai query builder (DB::table)
        DB::table('perkembangan_siswas')->insert([
            'siswa_id' => 3,
            'tanggal' => now(),
            'aspek' => 'Sosial',
            'jenis_perkembangan' => 'Kerjasama',
            'catatan' => 'Lebih aktif dalam kerja kelompok.',
            'penanggung_jawab' => 'Pak Budi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
