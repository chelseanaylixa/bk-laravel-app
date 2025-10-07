<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    protected $table = 'kasus';
    protected $fillable = [
        'nama_siswa',
        'kelas',
        'jurusan',
        'pelanggaran',
        'poin',
        'penanggung_jawab',
    ];
}
