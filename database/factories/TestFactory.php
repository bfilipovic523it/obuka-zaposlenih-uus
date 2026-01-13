<?php

namespace Database\Factories;

use App\Models\Obuka;
use App\Models\Prijava;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ocena' => fake()->numberBetween(-10000, 10000),
            'prijava_id' => Prijava::factory(),
            'obuka_id' => Obuka::factory(),
        ];
    }
}
