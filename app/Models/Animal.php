<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'name',
        'kode_satwa',   // [BARU] Tag ID individual satwa (Poin 2: Manajemen Medis Rinci)
        'amount',
        'feeding_detail',
        'health_status',
    ];

    /**
     * [BARU] Relasi ke riwayat penanganan kesehatan (Poin 2: Medical per individu)
     */
    public function penangananKesehatan()
    {
        return $this->hasMany(PenangananKesehatan::class, 'animal_id');
    }

    /**
     * [BARU] Helper: kembalikan kelas badge Tailwind berdasarkan status kesehatan
     * Digunakan di Blade View untuk Dynamic Badge (Poin 6)
     */
    public function getHealthBadgeClassAttribute(): string
    {
        return match($this->health_status) {
            'Sehat'                   => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
            'Sakit'                   => 'bg-red-500/10 text-red-400 border-red-500/20',
            'Karantina'               => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
            'Karantina/Penyembuhan'   => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
            'Penyembuhan'             => 'bg-orange-500/10 text-orange-400 border-orange-500/20',
            default                   => 'bg-white/8 text-white/60 border-white/10',
        };
    }

    /**
     * [BARU] Helper: warna dot animasi untuk badge status kesehatan (Poin 6)
     */
    public function getHealthDotClassAttribute(): string
    {
        return match($this->health_status) {
            'Sehat'                   => 'bg-emerald-400',
            'Sakit'                   => 'bg-red-400',
            'Karantina'               ,
            'Karantina/Penyembuhan'   => 'bg-yellow-400',
            'Penyembuhan'             => 'bg-orange-400',
            default                   => 'bg-white/40',
        };
    }
}
