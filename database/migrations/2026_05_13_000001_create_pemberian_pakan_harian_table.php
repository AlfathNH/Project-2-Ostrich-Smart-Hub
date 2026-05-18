<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel pemberian_pakan_harian — mencatat pemberian pakan harian oleh zookeeper.
     * Reset otomatis setiap hari (berbasis filter tanggal).
     * Saat ditandai, stok di tabel pembelian_pakan dikurangi.
     */
    public function up(): void
    {
        Schema::create('pemberian_pakan_harian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('animal_id');           // FK ke animals
            $table->string('animal_name');                      // Snapshot nama satwa
            $table->date('tanggal');                            // Tanggal pemberian (hari ini)
            $table->boolean('sudah_diberi')->default(false);    // Status pemberian
            $table->string('diberi_oleh')->nullable();          // Nama zookeeper
            $table->timestamp('waktu_pemberian')->nullable();   // Waktu klik tandai
            $table->string('nama_pakan_digunakan')->nullable(); // Nama pakan dari stok
            $table->decimal('jumlah_digunakan', 8, 2)->nullable(); // Jumlah stok yang dikurangi
            $table->string('satuan_digunakan')->nullable();     // Satuan pakan
            $table->text('catatan')->nullable();                // Catatan tambahan
            $table->timestamps();

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->unique(['animal_id', 'tanggal']); // 1 record per satwa per hari
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemberian_pakan_harian');
    }
};
