<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel penanganan_kesehatan — mencatat biaya penanganan/pengobatan hewan
     * yang dilakukan oleh dokter hewan (diinput admin berdasarkan laporan zookeeper).
     * Digunakan sebagai sumber PENGELUARAN kesehatan pada laporan keuangan manager.
     */
    public function up(): void
    {
        Schema::create('penanganan_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');                         // Tanggal penanganan
            $table->unsignedBigInteger('animal_id');         // FK ke tabel animals
            $table->string('nama_hewan');                    // Denormalized untuk kemudahan tampil
            $table->string('jenis_penanganan');              // Vaksinasi / Pengobatan / Cek Rutin / Operasi
            $table->bigInteger('biaya');                     // Biaya penanganan (Rp)
            $table->string('nama_dokter')->nullable();       // Nama dokter / drh
            $table->text('keterangan')->nullable();          // Catatan kondisi hewan
            $table->timestamps();

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penanganan_kesehatan');
    }
};
