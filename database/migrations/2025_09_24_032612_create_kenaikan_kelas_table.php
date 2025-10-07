<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kenaikan_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('nama_siswa');
            $table->string('kelas_lama');
            $table->string('kelas_baru');
            $table->string('tahun_ajaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kenaikan_kelas');
    }
};