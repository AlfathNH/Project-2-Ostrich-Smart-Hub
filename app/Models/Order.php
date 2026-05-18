<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Order — mewakili pembelian tiket masuk dari sistem checkout.
 * Sumber pemasukan utama pada laporan keuangan manager.
 */
class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'tanggal_order',
        'tanggal_kunjungan',
        'nama_pemesan',
        'phone',
        'jumlah_tiket',
        'harga_satuan',
        'total_harga',
        'metode_bayar',
        'catatan',
        'status',
    ];

    protected $casts = [
        'tanggal_order'     => 'date',
        'tanggal_kunjungan' => 'date',
        'jumlah_tiket'      => 'integer',
        'harga_satuan'      => 'integer',
        'total_harga'       => 'integer',
    ];

    /**
     * Relasi ke User pengunjung yang memesan tiket
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mengembalikan Kode Booking (Hash Unik Pendek)
     */
    public function getKodeBookingAttribute()
    {
        return strtoupper(substr(md5($this->id . $this->tanggal_order), 0, 8)) . '-' . $this->id;
    }
}
