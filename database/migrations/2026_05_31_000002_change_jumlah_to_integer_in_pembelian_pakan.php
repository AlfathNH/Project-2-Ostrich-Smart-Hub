<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// [BARU] Migrasi untuk mengubah kolom jumlah pada tabel pembelian_pakan dari decimal ke integer.
// Diperlukan untuk fitur Perbaikan Input Pakan Zookeeper (Poin 3) — input harus angka bulat.
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembelian_pakan', function (Blueprint $table) {
            // [BARU] Ubah dari decimal(8,2) ke integer (angka bulat)
            $table->integer('jumlah')->change();
        });
    }

    public function down(): void
    {
        Schema::table('pembelian_pakan', function (Blueprint $table) {
            // Rollback ke decimal jika diperlukan
            $table->decimal('jumlah', 8, 2)->change();
        });
    }
};
