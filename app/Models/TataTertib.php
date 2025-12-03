<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TataTertib extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database yang sesuai dengan model ini.
     * Diasumsikan tabel Anda bernama 'tata_tertib' (bentuk tunggal).
     * Jika nama tabel Anda adalah 'tata_tertibs' (bentuk jamak), baris ini boleh dihapus.
     *
     * @var string
     */
    protected $table = 'tata_tertibs';

    /**
     * Kolom yang tidak boleh diisi secara massal (mass assignable).
     * Karena id adalah primary key yang auto increment, kita lindungi.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id']; 
}