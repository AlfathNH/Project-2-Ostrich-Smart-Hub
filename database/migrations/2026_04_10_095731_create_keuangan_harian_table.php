<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel untuk menyimpan laporan keuangan harian Ostrich Mini Zoo.
     * Format mengacu pada spreadsheet Excel "Data Ostrich Mini Zoo":
     *   TANGGAL | URAIAN PENGELUARAN | TOTAL KELUAR | URAIAN MASUK | TOTAL MASUK | SALDO AWAL | SALDO AKHIR
     */
    public function up(): void
    {
        Schema::create('keuangan_harian', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');                            // Tanggal transaksi
            $table->string('bulan', 7);                        // Format: "2026-04" untuk filter per bulan
            $table->text('uraian_keluar')->nullable();          // Uraian Pengeluaran
            $table->bigInteger('total_keluar')->nullable()->default(0); // Total Keluar (Rp)
            $table->text('uraian_masuk')->nullable();           // Uraian Masuk
            $table->bigInteger('total_masuk')->nullable()->default(0);  // Total Masuk (Rp)
            $table->bigInteger('saldo_awal')->default(0);      // Saldo Awal hari itu
            $table->bigInteger('saldo_akhir')->default(0);     // Saldo Akhir = saldo_awal + total_masuk - total_keluar
            $table->string('keterangan')->nullable();           // Catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan_harian');
    }
};
