<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Test::create([
            'ocena' => '5',
            'prijava_id' => 1,
            'obuka_id' => 1,
        ]);

        Test::create([
            'ocena' => '4',
            'prijava_id' => 3,
            'obuka_id' => 3,
        ]);
    }
}
