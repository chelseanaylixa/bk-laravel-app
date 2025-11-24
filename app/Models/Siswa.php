<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Kasus;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nis',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
    ];

    /**
     * Get the user associated with this siswa.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all kasus for this siswa.
     */
    public function kasus(): HasMany
    {
        return $this->hasMany(Kasus::class, 'siswa_id');
    }

    /**
     * Get total poin for this siswa.
     */
    public function getTotalPoin()
    {
        return Kasus::where('siswa_id', $this->id)
            ->with('pelanggaran')
            ->get()
            ->sum(function ($kasus) {
                return $kasus->pelanggaran->jumlah_poin ?? 0;
            });
    }
}
