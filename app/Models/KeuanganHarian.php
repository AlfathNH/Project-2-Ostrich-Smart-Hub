<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk tabel keuangan_harian.
 * Menyimpan catatan keuangan harian Ostrich Mini Zoo.
 * Kolom: tanggal, bulan, uraian_keluar, total_keluar, uraian_masuk, total_masuk, saldo_awal, saldo_akhir, keterangan
 */
class KeuanganHarian extends Model
{
    protected $table = 'keuangan_harian';

    protected $fillable = [
        'tanggal',
        'bulan',
        'uraian_keluar',
        'total_keluar',
        'uraian_masuk',
        'total_masuk',
        'saldo_awal',
        'saldo_akhir',
        'keterangan',
    ];

    protected $casts = [
        'tanggal'      => 'date',
        'total_keluar' => 'integer',
        'total_masuk'  => 'integer',
        'saldo_awal'   => 'integer',
        'saldo_akhir'  => 'integer',
    ];
}
