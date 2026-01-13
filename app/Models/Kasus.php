<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kasus extends Model
{
    protected $table = 'kasus';
    protected $fillable = [
        'siswa_id',
        'pelanggaran_id',
        'tanggal',
        'status',
        'catatan',
    ];

    /**
     * Get the siswa that owns this kasus.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    /**
     * Get the pelanggaran details for this kasus.
     */
    public function pelanggaran(): BelongsTo
    {
        return $this->belongsTo(Pelanggaran::class, 'pelanggaran_id');
    }

    /**
     * Get total poin for a specific siswa.
     */
    public static function getTotalPoinBySiswa($siswaId)
    {
        return self::where('siswa_id', $siswaId)
            ->with('pelanggaran')
            ->get()
            ->sum(function ($kasus) {
                return $kasus->pelanggaran->jumlah_poin ?? 0;
            });
    }

    /**
     * Get all kasus for a specific siswa, ordered by latest.
     */
    public static function getKasusBySiswa($siswaId)
    {
        return self::where('siswa_id', $siswaId)
            ->with(['pelanggaran'])
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
