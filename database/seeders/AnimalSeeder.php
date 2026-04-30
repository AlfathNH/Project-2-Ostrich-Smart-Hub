<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    public function run(): void
    {
        $animals = [
            ['name' => 'Ostrich', 'amount' => 2, 'feeding_detail' => 'Sayur (4 Kg), Pur 511P (1 kg), Pur BR21 (1kg)'],
            ['name' => 'Merak', 'amount' => 4, 'feeding_detail' => 'Jagung (400g), Gabah (200g), Kacang hijau (200g)'],
            ['name' => 'Ikan Nila', 'amount' => 300, 'feeding_detail' => 'Pelet ikan (2kg)'],
            ['name' => 'Iguana', 'amount' => 6, 'feeding_detail' => 'Sayur (1kg)'],
            ['name' => 'Nuri Bayan', 'amount' => 2, 'feeding_detail' => 'Pisang (300g), Pepaya (300g)'],
            ['name' => 'Kuda', 'amount' => 7, 'feeding_detail' => 'Pelet RH (14 kg), Rumput'],
            ['name' => 'Kambing Etawa', 'amount' => 4, 'feeding_detail' => 'Konsentrat (5kg), Rumput'],
            ['name' => 'Bebek Mandarin', 'amount' => 6, 'feeding_detail' => 'Pur BR21 (500g), Pur 511 (500g), Nasi (1kg)'],
            ['name' => 'Jalak Suren', 'amount' => 1, 'feeding_detail' => 'Pisang (200g)'],
            ['name' => 'Monyet Pantai', 'amount' => 2, 'feeding_detail' => 'Pisang (500g), Pepaya (500g)'],
            ['name' => 'Kalkun', 'amount' => 4, 'feeding_detail' => 'Pur BR21 (800g), Pur 511 (800g), Nasi (2kg)'],
            ['name' => 'Rusa Tutul', 'amount' => 2, 'feeding_detail' => 'Pelet RH (2kg), Rumput'],
            ['name' => 'Binturong', 'amount' => 4, 'feeding_detail' => 'Pepaya (4 kg), Pisang (4 kg), Kepala ayam (4)'],
            ['name' => 'Musang', 'amount' => 2, 'feeding_detail' => 'Pisang (1,2 kg), Kepala ayam (2)'],
            ['name' => 'Nuri Pelangi', 'amount' => 2, 'feeding_detail' => 'Pisang (250 g), Pepaya (250 g)'],
            ['name' => 'Meerket', 'amount' => 3, 'feeding_detail' => 'Daging (800g), Telur (2)'],
            ['name' => 'Kenari', 'amount' => 4, 'feeding_detail' => 'Pur Kenari'],
            ['name' => 'Nuri Kepala Hitam', 'amount' => 5, 'feeding_detail' => 'Pisang (1 kg), Pepaya (1 kg)'],
            ['name' => 'Jalak Bali', 'amount' => 4, 'feeding_detail' => 'Pur Burung Mateng'],
            ['name' => 'Lovebird', 'amount' => 9, 'feeding_detail' => 'Millet'],
            ['name' => 'Sulcata', 'amount' => 3, 'feeding_detail' => 'Sayur (2 kg), Pisang (300g)'],
            ['name' => 'Domba Marino', 'amount' => 3, 'feeding_detail' => 'Konsentrat (4kg), Rumput'],
            ['name' => 'Kambing Afrika', 'amount' => 2, 'feeding_detail' => 'Konsentrat (3kg), Rumput'],
            ['name' => 'Black Swan', 'amount' => 2, 'feeding_detail' => 'Sayur (400g), Pur 511 (400g), Pur BR21E (400g)'],
            ['name' => 'Angsa', 'amount' => 3, 'feeding_detail' => 'Pur BR21 (700g), Pur 511 (700g), Nasi (1kg)'],
            ['name' => 'Owa Jawa', 'amount' => 1, 'feeding_detail' => 'Pisang (200g)'],
        ];

        foreach ($animals as $animal) {
            Animal::create($animal);
        }
    }
}
