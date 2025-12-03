<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tata_tertibs', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');         // Misal: Kedisiplinan, Kerapian
            $table->string('jenis_pelanggaran'); // Misal: Terlambat, Atribut tidak lengkap
            $table->text('sanksi');             // Misal: Poin 10, Panggilan Ortu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tata_tertibs');
    }
};