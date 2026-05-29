<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->string('id_transaksi')->primary();
            $table->string('nama_user');
            $table->string('email_user');
            $table->integer('jumlah_tiket');
            $table->integer('total_harga'); // Sudah termasuk kode unik
            $table->string('bukti_transfer')->nullable();
            $table->enum('status', ['PENDING', 'SUCCESS', 'REJECTED'])->default('PENDING');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
