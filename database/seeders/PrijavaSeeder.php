<?php

namespace Database\Seeders;

use App\Models\Prijava;
use Illuminate\Database\Seeder;

class PrijavaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prijava::create([
            'status' => 'Zavrsena',
            'datum' => '2025-11-01',
            'user_id' => 5,
            'obuka_id' => 1,
        ]);

        Prijava::create([
            'status' => 'Aktivna',
            'datum' => '2026-01-05',
            'user_id' => 5,
            'obuka_id' => 2,
        ]);

        Prijava::create([
            'status' => 'Zavrsena',
            'datum' => '2025-12-01',
            'user_id' => 6,
            'obuka_id' => 3,
        ]);

        Prijava::create([
            'status' => 'Aktivna',
            'datum' => '2026-01-03',
            'user_id' => 6,
            'obuka_id' => 4,
        ]);
    }
}
