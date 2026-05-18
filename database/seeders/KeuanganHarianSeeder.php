<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KeuanganHarian;

/**
 * Seeder data keuangan harian Ostrich Mini Zoo.
 * Data contoh mengacu pada spreadsheet Excel "Data Ostrich Mini Zoo - April 2026"
 */
class KeuanganHarianSeeder extends Seeder
{
    public function run(): void
    {
        // Saldo awal bulan April
        $saldoAwal = 2500000;
        $saldo = $saldoAwal;

        $dataHarian = [
            // Format: [tanggal, uraian_keluar, total_keluar, uraian_masuk, total_masuk, keterangan]
            ['2026-04-01', 'Makan karyawan',           75000,  'Tiket masuk (15)',              375000, ''],
            ['2026-04-02', null,                        0,      'Tiket masuk (10)',              250000, ''],
            ['2026-04-03', 'Pakan burung unta 20kg',   120000, 'Tiket masuk (22)',              550000, ''],
            ['2026-04-04', 'Listrik & air',            350000, 'Tunggang kuda (8)',             160000, ''],
            ['2026-04-05', null,                        0,      'Tiket masuk (30)',              750000, 'Akhir pekan ramai'],
            ['2026-04-06', 'Kebersihan &  sanitasi',   85000,  'Tiket masuk (28)',              700000, 'Akhir pekan'],
            ['2026-04-07', 'Makan karyawan',           75000,  'Tiket masuk (12)',              300000, ''],
            ['2026-04-08', 'Pisang reject 18kg',       45000,  'Tiket masuk (7)',               175000, ''],
            ['2026-04-09', 'Makan karyawan',           75000,  'Outingclass RA Waladun+Ortu',   650000, 'Kunjungan TK/RA'],
            ['2026-04-09', null,                        0,      'Tunggang kuda (12)',            240000, ''],
            ['2026-04-10', 'Obat-obatan hewan',        200000, 'Tiket masuk (18)',              450000, ''],
            ['2026-04-11', 'Pakan alpukat & wortel',   95000,  'Tiket masuk (11)',              275000, ''],
            ['2026-04-12', null,                        0,      'Tiket masuk (35)',              875000, 'Akhir pekan'],
            ['2026-04-13', 'Makan karyawan',           75000,  'Tiket masuk (29)',              725000, 'Akhir pekan'],
            ['2026-04-14', 'Gaji pegawai harian',      500000, 'Tiket masuk (9)',               225000, ''],
            ['2026-04-15', 'Perawatan kandang',        180000, 'Tiket masuk (14)',              350000, ''],
        ];

        foreach ($dataHarian as $item) {
            [$tanggal, $uraian_keluar, $total_keluar, $uraian_masuk, $total_masuk, $keterangan] = $item;

            $saldoAwalBaris = $saldo;
            $saldoAkhir = $saldo + $total_masuk - $total_keluar;

            KeuanganHarian::create([
                'tanggal'       => $tanggal,
                'bulan'         => substr($tanggal, 0, 7), // "2026-04"
                'uraian_keluar' => $uraian_keluar,
                'total_keluar'  => $total_keluar,
                'uraian_masuk'  => $uraian_masuk,
                'total_masuk'   => $total_masuk,
                'saldo_awal'    => $saldoAwalBaris,
                'saldo_akhir'   => $saldoAkhir,
                'keterangan'    => $keterangan,
            ]);

            $saldo = $saldoAkhir;
        }
    }
}
