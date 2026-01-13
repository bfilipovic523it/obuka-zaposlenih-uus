<?php

namespace Database\Seeders;

use App\Models\Materijal;
use Illuminate\Database\Seeder;

class MaterijalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Materijal::create([
            'naziv' => 'Microsoft office za pocetnike',
            'user_id' => 3,
        ]);

        Materijal::create([
            'naziv' => 'Microsoft Excel',
            'user_id' => 3,
        ]);

        Materijal::create([
            'naziv' => 'Osnove marketinga i prodaje',
            'user_id' => 4,
        ]);

        Materijal::create([
            'naziv' => 'Digitalni marketing',
            'user_id' => 4,
        ]);
    }
}
