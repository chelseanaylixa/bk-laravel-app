<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kasus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('pelanggaran');
            $table->integer('poin');
            $table->string('penanggung_jawab');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kasus');
    }
};
