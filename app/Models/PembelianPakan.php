<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model PembelianPakan — mencatat pembelian bahan pakan hewan.
 * Sumber pengeluaran pakan pada laporan keuangan manager.
 */
class PembelianPakan extends Model
{
    protected $table = 'pembelian_pakan';

    protected $fillable = [
        'tanggal',
        'nama_pakan',
        'jumlah',
        'satuan',
        'harga_satuan',
        'total_harga',
        'pelapor',
        'keterangan',
    ];

    protected $casts = [
        'tanggal'      => 'date',
        'jumlah'       => 'float',
        'harga_satuan' => 'integer',
        'total_harga'  => 'integer',
    ];
}
