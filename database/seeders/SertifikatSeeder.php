<?php

namespace Database\Seeders;

use App\Models\Sertifikat;
use Illuminate\Database\Seeder;

class SertifikatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sertifikat::create([
            'kod' => 'AABB-BBCC-CCDD',
            'datum_izdavanja' => '2025-11-12',
            'prijava_id' => 1,
        ]);

        Sertifikat::create([
            'kod' => 'BBCC-CCDD-DDEE',
            'datum_izdavanja' => '2026-01-02',
            'prijava_id' => 3,
        ]);
    }
}
