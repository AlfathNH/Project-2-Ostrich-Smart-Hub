<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

/**
 * Seeder data contoh pembelian tiket — simulasi transaksi tiket April 2026.
 */
class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $harga = 25000;

        $data = [
            ['2026-04-01', '2026-04-01', 'Budi Santoso',      '08111111111', 15, 'qris'],
            ['2026-04-02', '2026-04-02', 'Siti Rahayu',       '08122222222', 10, 'transfer'],
            ['2026-04-03', '2026-04-03', 'Ahmad Fauzi',       '08133333333', 22, 'qris'],
            ['2026-04-04', '2026-04-04', 'Dewi Lestari',      '08144444444',  8, 'ewallet'],
            ['2026-04-05', '2026-04-05', 'Rizky Pratama',     '08155555555', 30, 'qris'],
            ['2026-04-06', '2026-04-06', 'Fatimah Azzahra',   '08166666666', 28, 'transfer'],
            ['2026-04-07', '2026-04-08', 'Hendra Wijaya',     '08177777777', 12, 'qris'],
            ['2026-04-08', '2026-04-09', 'Putri Ayu',         '08188888888',  7, 'ewallet'],
            ['2026-04-09', '2026-04-09', 'RA Waladun (Group)','08199999999', 30, 'transfer'],
            ['2026-04-10', '2026-04-10', 'Yusuf Ramadhan',    '08100000001', 18, 'qris'],
            ['2026-04-11', '2026-04-11', 'Nur Hidayah',       '08100000002', 11, 'qris'],
            ['2026-04-12', '2026-04-13', 'Keluarga Susanto',  '08100000003', 35, 'transfer'],
            ['2026-04-13', '2026-04-13', 'Agus Supriyono',    '08100000004', 29, 'qris'],
            ['2026-04-14', '2026-04-15', 'Maya Indira',       '08100000005',  9, 'ewallet'],
            ['2026-04-15', '2026-04-15', 'Dian Permata',      '08100000006', 14, 'qris'],
        ];

        foreach ($data as [$tgl_order, $tgl_kunjungan, $nama, $phone, $qty, $metode]) {
            Order::create([
                'tanggal_order'     => $tgl_order,
                'tanggal_kunjungan' => $tgl_kunjungan,
                'nama_pemesan'      => $nama,
                'phone'             => $phone,
                'jumlah_tiket'      => $qty,
                'harga_satuan'      => $harga,
                'total_harga'       => $qty * $harga,
                'metode_bayar'      => $metode,
                'status'            => 'confirmed',
            ]);
        }
    }
}
