<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pindah_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('nama_siswa');
            $table->string('kelas_asal');
            $table->string('kelas_tujuan');
            $table->date('tanggal_pindah');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pindah_kelas');
    }
};