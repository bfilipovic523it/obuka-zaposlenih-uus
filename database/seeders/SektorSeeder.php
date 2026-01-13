<?php

namespace Database\Seeders;

use App\Models\Sektor;
use Illuminate\Database\Seeder;

class SektorSeeder extends Seeder
{
    public function run(): void
    {
        Sektor::create(['naziv' => 'IT']);
        Sektor::create(['naziv' => 'Marketing i prodaja']);
    }
}