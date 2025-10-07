<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('riwayat_konselings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('guru_bk_id');
            $table->string('topik');
            $table->text('catatan');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('guru_bk_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_konselings');
    }
};
