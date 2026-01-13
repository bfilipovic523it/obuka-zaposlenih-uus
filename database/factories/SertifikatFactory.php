<?php

namespace Database\Factories;

use App\Models\Prijava;
use Illuminate\Database\Eloquent\Factories\Factory;

class SertifikatFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'kod' => fake()->regexify('[A-Za-z0-9]{20}'),
            'datum_izdavanja' => fake()->date(),
            'prijava_id' => Prijava::factory(),
        ];
    }
}
