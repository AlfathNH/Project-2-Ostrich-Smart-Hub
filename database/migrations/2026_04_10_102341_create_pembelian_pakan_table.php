<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel pembelian_pakan — mencatat pembelian bahan pakan oleh admin
     * ketika stok menipis (berdasarkan laporan dari zookeeper).
     * Digunakan sebagai sumber PENGELUARAN pakan pada laporan keuangan manager.
     */
    public function up(): void
    {
        Schema::create('pembelian_pakan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');                         // Tanggal pembelian
            $table->string('nama_pakan');                    // Nama bahan: pisang, wortel, pellet, dll
            $table->decimal('jumlah', 8, 2);                 // Qty (bisa desimal: 1.5 kg)
            $table->string('satuan');                        // kg / ikat / buah / liter / sak
            $table->bigInteger('harga_satuan');              // Harga per satuan (Rp)
            $table->bigInteger('total_harga');               // = jumlah × harga_satuan
            $table->string('pelapor')->nullable();           // Nama zookeeper yang melaporkan stok menipis
            $table->text('keterangan')->nullable();          // Catatan tambahan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembelian_pakan');
    }
};
