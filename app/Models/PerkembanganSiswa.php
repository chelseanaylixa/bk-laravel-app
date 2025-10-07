<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkembanganSiswa extends Model
{
    use HasFactory;

    protected $table = 'perkembangan_siswas';

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'aspek',
        'catatan',
        'penanggung_jawab',
    ];

     public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
