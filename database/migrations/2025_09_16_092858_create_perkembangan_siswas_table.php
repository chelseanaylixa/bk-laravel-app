<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perkembangan_siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id'); // relasi ke users
            $table->date('tanggal');                // tanggal catatan
            $table->string('aspek');                // aspek perkembangan
            $table->text('catatan');                // catatan detail
            $table->string('penanggung_jawab');     // guru BK / wali kelas
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perkembangan_siswas');
    }
};
