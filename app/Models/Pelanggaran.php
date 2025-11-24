<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggaran extends Model
{
    protected $table = 'pelanggaran';
    protected $fillable = [
        'nama_pelanggaran',
        'kategori',
        'deskripsi',
        'jumlah_poin',
    ];

    /**
     * Get all kasus for this pelanggaran type.
     */
    public function kasus(): HasMany
    {
        return $this->hasMany(Kasus::class, 'pelanggaran_id');
    }
}
