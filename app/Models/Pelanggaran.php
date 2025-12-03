<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggaran';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_pelanggaran',
        'kategori',
        'deskripsi',
        'jumlah_poin',
    ];

    // Kolom yang dilindungi dari mass assignment (alternatif dari fillable)
    // Saya menggunakan $fillable di atas, jadi ini di-comment atau dihapus jika tidak perlu
    // protected $guarded = ['id']; 

    /**
     * Mendapatkan semua riwayat kasus (misalnya, Kasus) yang terkait dengan jenis pelanggaran ini.
     * Diasumsikan ada model Kasus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kasus(): HasMany
    {
        // Menghubungkan ke model Kasus menggunakan foreign key 'pelanggaran_id'
        return $this->hasMany(Kasus::class, 'pelanggaran_id');
    }
    
}