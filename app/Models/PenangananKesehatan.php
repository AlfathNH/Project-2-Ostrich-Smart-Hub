<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model PenangananKesehatan — mencatat biaya penanganan/pengobatan hewan.
 * Sumber pengeluaran kesehatan pada laporan keuangan manager.
 */
class PenangananKesehatan extends Model
{
    protected $table = 'penanganan_kesehatan';

    protected $fillable = [
        'tanggal',
        'animal_id',
        'nama_hewan',
        'jenis_penanganan',
        'biaya',
        'nama_dokter',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'biaya'   => 'integer',
    ];

    /** Relasi ke hewan */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
