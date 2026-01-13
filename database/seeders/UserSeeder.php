<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Ana Petrovic',
            'email' => 'apetrovic@eduka.rs',
            'password' => bcrypt('password'),
            'uloga_id' => 1, 
            'sektor_id' => 1,
        ]);

        User::create([
            'name' => 'Nikola Ristic',
            'email' => 'nristic@eduka.rs',
            'password' => bcrypt('password'),
            'uloga_id' => 1, 
            'sektor_id' => 2,
        ]);

        User::create([
            'name' => 'Marko Ilic',
            'email' => 'milic@eduka.rs',
            'password' => bcrypt('password'),
            'uloga_id' => 2, 
            'sektor_id' => 1,
        ]);

        User::create([
            'name' => 'Nenad Nikolic',
            'email' => 'nnikolic@eduka.rs',
            'password' => bcrypt('password'),
            'uloga_id' => 2, 
            'sektor_id' => 2,
        ]);

        User::create([
            'name' => 'Jelena Stankovic',
            'email' => 'jstankovic@eduka.rs',
            'password' => bcrypt('password'),
            'uloga_id' => 3, 
            'sektor_id' => 1,
        ]);

        User::create([
            'name' => 'Milan Jovanovic',
            'email' => 'mjovanovic@eduka.rs',
            'password' => bcrypt('password'),
            'uloga_id' => 3, 
            'sektor_id' => 2,
        ]);
    }
}
