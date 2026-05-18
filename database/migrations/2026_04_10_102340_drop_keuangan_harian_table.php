<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Drop tabel keuangan_harian karena laporan diganti dengan 3 tabel sistem yang lebih akurat. */
    public function up(): void
    {
        Schema::dropIfExists('keuangan_harian');
    }

    public function down(): void
    {
        // Tabel tidak perlu di-restore
    }
};
