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
        'bukti_transfer',
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

    // [BARU] ===== POIN 5: RETENSI DATA 6 BULAN =====

    /**
     * [BARU] Scope untuk hanya mengambil data dalam 6 bulan terakhir.
     * Gunakan: Order::sixMonths()->get()
     */
    public function scopeSixMonths($query)
    {
        return $query->where('created_at', '>=', now()->subMonths(6));
    }

    // [BARU] ===== POIN 1: LABEL STATUS BAHASA INDONESIA =====

    /**
     * [BARU] Accessor: mengembalikan label status dalam Bahasa Indonesia penuh.
     * pending -> "Menunggu", confirmed -> "Terkonfirmasi", rejected -> "Ditolak"
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'confirmed' => 'Terkonfirmasi',
            'rejected'  => 'Ditolak',
            default     => 'Menunggu',
        };
    }

    /**
     * [BARU] Accessor: class CSS badge berdasarkan status untuk Tailwind (Poin 1)
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'confirmed' => 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20',
            'rejected'  => 'bg-red-500/10 text-red-400 border border-red-500/20',
            default     => 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20',
        };
    }

    /**
     * [BARU] Accessor: warna dot indikator status (Poin 1)
     */
    public function getStatusDotClassAttribute(): string
    {
        return match($this->status) {
            'confirmed' => 'bg-emerald-400',
            'rejected'  => 'bg-red-400',
            default     => 'bg-yellow-400',
        };
    }
}
