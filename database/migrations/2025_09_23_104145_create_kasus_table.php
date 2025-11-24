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
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('pelanggaran_id');
            $table->date('tanggal');
            $table->enum('status', ['diproses', 'selesai'])->default('diproses');
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('pelanggaran_id')->references('id')->on('pelanggaran')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kasus');
    }
};
