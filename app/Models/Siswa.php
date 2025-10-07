<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'kelas',
        'jurusan',
    ];

    // Relasi ke perkembangan siswa
    public function perkembangan()
    {
        return $this->hasMany(PerkembanganSiswa::class, 'siswa_id');
    }
}
