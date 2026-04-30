<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
{
    \App\Models\Staff::truncate();
    \App\Models\Staff::create([
        'name' => 'Manajer Ostrich',
        'username' => 'manager',
        'password' => bcrypt('manager123'),
        'role' => 'Manager'
    ]);
    \App\Models\Staff::create([
        'name' => 'Rizky (Admin)',
        'username' => 'admin',
        'password' => bcrypt('admin123'),
        'role' => 'Admin'
    ]);
    \App\Models\Staff::create([
        'name' => 'Alfath (Zookeeper)',
        'username' => 'zookeeper',
        'password' => bcrypt('zoo123'),
        'role' => 'Zookeeper'
    ]);
}
}
