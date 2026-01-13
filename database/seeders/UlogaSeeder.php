<?php

namespace Database\Seeders;

use App\Models\Uloga;
use Illuminate\Database\Seeder;

class UlogaSeeder extends Seeder
{
    public function run(): void
    {
        Uloga::create(['naziv' => 'Administrator']);
        Uloga::create(['naziv' => 'Predavac']);
        Uloga::create(['naziv' => 'Zaposleni']);
    }
}