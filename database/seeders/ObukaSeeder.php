<?php

namespace Database\Seeders;

use App\Models\Obuka;
use Illuminate\Database\Seeder;

class ObukaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Obuka::create([
            'naziv' => 'Osnove Microsoft Excel',
            'opis' => 'Ova obuka pruza polaznicima da steknu osnovno znanje za rad u Microsoft Excel',
            'broj_mesta' => 30,
            'datum_pocetka' => '2025-11-04',
            'datum_zavrsetka' => '2025-11-10',
            'user_id' => 3,
            'sektor_id' => 1,
            'materijal_id' => 1,
        ]);

        Obuka::create([
            'naziv' => 'Napredni Microsoft Excel',
            'opis' => 'Ova obuka pruza polaznicima da u potpunosti steknu znanje za rad u Microsoft Excel',
            'broj_mesta' => 20,
            'datum_pocetka' => '2026-02-03',
            'datum_zavrsetka' => '20266-02-08',
            'user_id' => 3,
            'sektor_id' => 1,
            'materijal_id' => 2,
        ]);

        Obuka::create([
            'naziv' => 'Osnove marketinga i prodaje',
            'opis' => 'Ova obuka pruza polaznicima da steknu osnovne vestine u oblasti marketinga i prodaje',
            'broj_mesta' => 15,
            'datum_pocetka' => '2025-12-20',
            'datum_zavrsetka' => '2025-12-28',
            'user_id' => 4,
            'sektor_id' => 2,
            'materijal_id' => 3,
        ]);

        Obuka::create([
            'naziv' => 'Digitalni marketing',
            'opis' => 'Ova obuka pruza polaznicima da steknu vestine u oblasti digitalnog marketinga',
            'broj_mesta' => 8,
            'datum_pocetka' => '2026-01-30',
            'datum_zavrsetka' => '2025-02-05',
            'user_id' => 4,
            'sektor_id' => 2,
            'materijal_id' => 4,
        ]);
    }
}
