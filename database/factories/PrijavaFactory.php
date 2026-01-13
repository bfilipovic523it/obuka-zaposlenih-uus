<?php

namespace Database\Factories;

use App\Models\Obuka;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrijavaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'status' => fake()->regexify('[A-Za-z0-9]{50}'),
            'datum' => fake()->date(),
            'user_id' => User::factory(),
            'obuka_id' => Obuka::factory(),
        ];
    }
}
