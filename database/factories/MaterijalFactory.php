<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterijalFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->regexify('[A-Za-z0-9]{150}'),
            'user_id' => User::factory(),
        ];
    }
}
