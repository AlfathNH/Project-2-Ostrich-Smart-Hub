<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Animal;
use App\Models\PenangananKesehatan;

/**
 * Seeder data contoh penanganan kesehatan hewan — bulan April 2026.
 */
class KesehatanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil animal pertama (fallback jika tidak ada data)
        $animals = Animal::all();
        if ($animals->isEmpty()) return;

        $data = [
            [
                'tanggal'          => '2026-04-02',
                'jenis_penanganan' => 'Pemeriksaan Rutin',
                'biaya'            => 150000,
                'nama_dokter'     => 'drh. Beni Santoso',
                'keterangan'      => 'Cek kesehatan bulanan seluruh koloni burung unta',
            ],
            [
                'tanggal'          => '2026-04-06',
                'jenis_penanganan' => 'Vaksinasi Newcastle Disease',
                'biaya'            => 350000,
                'nama_dokter'     => 'drh. Rina Hartati',
                'keterangan'      => 'Vaksin rutin untuk mencegah penyakit pernapasan',
            ],
            [
                'tanggal'          => '2026-04-09',
                'jenis_penanganan' => 'Pengobatan Luka',
                'biaya'            => 200000,
                'nama_dokter'     => 'drh. Beni Santoso',
                'keterangan'      => 'Hewan terluka di bagian kaki, laporan dari zookeeper Rudi',
            ],
            [
                'tanggal'          => '2026-04-13',
                'jenis_penanganan' => 'Vitamin & Suplemen',
                'biaya'            => 125000,
                'nama_dokter'     => 'drh. Rina Hartati',
                'keterangan'      => 'Suplemen rutin pasca pemeriksaan',
            ],
        ];

        foreach ($data as $i => $item) {
            // Ambil animal secara bergilir
            $animal = $animals[$i % $animals->count()];
            PenangananKesehatan::create([
                'tanggal'          => $item['tanggal'],
                'animal_id'        => $animal->id,
                'nama_hewan'       => $animal->name,
                'jenis_penanganan' => $item['jenis_penanganan'],
                'biaya'            => $item['biaya'],
                'nama_dokter'     => $item['nama_dokter'],
                'keterangan'      => $item['keterangan'],
            ]);
        }
    }
}
