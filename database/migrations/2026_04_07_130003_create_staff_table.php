<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('staff', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('role'); // Contoh: Kasir, Zookeeper [cite: 503, 504]
        $table->string('status')->default('Bertugas'); // Bertugas / Libur
        $table->string('last_activity')->nullable(); // Aktivitas terakhir
        $table->timestamps();
    });
}
};
