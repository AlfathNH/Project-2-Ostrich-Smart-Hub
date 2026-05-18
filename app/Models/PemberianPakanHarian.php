<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model PemberianPakanHarian — mencatat pemberian pakan harian oleh zookeeper.
 * Satu record per satwa per hari. Reset otomatis via filter tanggal.
 */
class PemberianPakanHarian extends Model
{
    protected $table = 'pemberian_pakan_harian';

    protected $fillable = [
        'animal_id',
        'animal_name',
        'tanggal',
        'sudah_diberi',
        'diberi_oleh',
        'waktu_pemberian',
        'nama_pakan_digunakan',
        'jumlah_digunakan',
        'satuan_digunakan',
        'catatan',
    ];

    protected $casts = [
        'tanggal'          => 'date',
        'sudah_diberi'     => 'boolean',
        'waktu_pemberian'  => 'datetime',
        'jumlah_digunakan' => 'float',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
