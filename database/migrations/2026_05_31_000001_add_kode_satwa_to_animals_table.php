<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

// [BARU] Migrasi untuk menambahkan kolom kode_satwa (Tag ID individual) pada tabel animals.
// Diperlukan untuk fitur Manajemen Medis Satwa Rinci (identifikasi per ekor/individual).
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            // [BARU] Kolom tag ID unik per individu satwa, contoh: UNTA-001, BURUNG-003
            $table->string('kode_satwa')->nullable()->unique()->after('name');
        });

        // [BARU] Isi kode_satwa secara otomatis untuk data lama yang sudah ada
        $animals = DB::table('animals')->orderBy('id')->get();
        foreach ($animals as $animal) {
            $prefix = strtoupper(substr(preg_replace('/\s+/', '', $animal->name), 0, 4));
            $kode   = $prefix . '-' . str_pad($animal->id, 3, '0', STR_PAD_LEFT);
            DB::table('animals')->where('id', $animal->id)->update(['kode_satwa' => $kode]);
        }
    }

    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn('kode_satwa');
        });
    }
};
