<?php

namespace Database\Factories;

use App\Models\Materijal;
use App\Models\Sektor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObukaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->regexify('[A-Za-z0-9]{150}'),
            'opis' => fake()->text(),
            'broj_mesta' => fake()->numberBetween(-10000, 10000),
            'datum_pocetka' => fake()->date(),
            'datum_zavrsetka' => fake()->date(),
            'user_id' => User::factory(),
            'sektor_id' => Sektor::factory(),
            'materijal_id' => Materijal::factory(),
        ];
    }
}
