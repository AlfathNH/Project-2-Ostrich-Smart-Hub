<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel orders — menyimpan pembelian tiket dari sistem checkout.
     * Digunakan sebagai sumber PEMASUKAN pada laporan keuangan manager.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_order');        // Tanggal transaksi / pembelian tiket
            $table->date('tanggal_kunjungan');    // Tanggal rencana kunjungan
            $table->string('nama_pemesan');
            $table->string('phone');
            $table->integer('jumlah_tiket');
            $table->bigInteger('harga_satuan');
            $table->bigInteger('total_harga');
            $table->string('metode_bayar');       // qris / transfer / ewallet
            $table->text('catatan')->nullable();
            $table->string('status')->default('confirmed'); // confirmed / pending / cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
