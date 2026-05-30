<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// [BARU] Menambahkan kolom identifikasi individu sakit pada tabel penanganan_kesehatan.
// Menyimpan jumlah ekor yang sakit dan kode-kode satwa individual yang terdampak,
// tanpa mengubah cara input utama (nama hewan tetap per-spesies, bukan per-ekor).
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penanganan_kesehatan', function (Blueprint $table) {
            // Jumlah ekor yang sakit/ditangani dari spesies tersebut
            $table->unsignedTinyInteger('jumlah_sakit')->default(1)->after('nama_hewan');
            // Kode individu yang ditandai sakit, disimpan sebagai string JSON-like
            // contoh: "UNTA-001, UNTA-003" atau "Semua (6 ekor)"
            $table->string('kode_sakit')->nullable()->after('jumlah_sakit');
        });
    }

    public function down(): void
    {
        Schema::table('penanganan_kesehatan', function (Blueprint $table) {
            $table->dropColumn(['jumlah_sakit', 'kode_sakit']);
        });
    }
};
