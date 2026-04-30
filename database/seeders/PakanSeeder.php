<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PembelianPakan;

/**
 * Seeder data contoh pembelian pakan — bulan April 2026.
 * Mencerminkan pembelian aktual ketika stok menipis dilaporkan zookeeper.
 */
class PakanSeeder extends Seeder
{
    public function run(): void
    {
        // Format: [tanggal, nama_pakan, jumlah, satuan, harga_satuan, pelapor, keterangan]
        $data = [
            ['2026-04-01', 'Pisang Kepok',    50,   'kg',   3000,  'Rudi (ZK)',     'Stok pisang habis, untuk burung unta'],
            ['2026-04-03', 'Wortel',          20,   'kg',   5000,  'Rudi (ZK)',     'Pakan tambahan iguana & kura-kura'],
            ['2026-04-05', 'Pelet Burung',    10,   'kg',   25000, 'Sari (ZK)',     'Stok pelet tinggal 2 kg'],
            ['2026-04-07', 'Pisang Kepok',    30,   'kg',   3000,  'Rudi (ZK)',     'Pembelian rutin mingguan'],
            ['2026-04-08', 'Bayam & Kangkung', 15,  'ikat', 2000,  'Andi (ZK)',     'Sayuran untuk herbivora kecil'],
            ['2026-04-10', 'Ulat Hongkong',   2,    'kg',   80000, 'Sari (ZK)',     'Pakan protein untuk reptil'],
            ['2026-04-12', 'Pisang Kepok',    60,   'kg',   3000,  'Rudi (ZK)',     'Stok akhir pekan habis cepat'],
            ['2026-04-14', 'Jagung Pipil',    25,   'kg',   8000,  'Andi (ZK)',     'Pakan tambahan unggas'],
            ['2026-04-15', 'Rumput Gajah',    100,  'kg',   1500,  'Rudi (ZK)',     'Untuk herbivora besar'],
        ];

        foreach ($data as [$tgl, $nama, $jml, $satuan, $harga, $pelapor, $ket]) {
            PembelianPakan::create([
                'tanggal'      => $tgl,
                'nama_pakan'   => $nama,
                'jumlah'       => $jml,
                'satuan'       => $satuan,
                'harga_satuan' => $harga,
                'total_harga'  => $jml * $harga,
                'pelapor'      => $pelapor,
                'keterangan'   => $ket,
            ]);
        }
    }
}
