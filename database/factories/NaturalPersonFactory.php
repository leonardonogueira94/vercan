<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class NaturalPersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cpf' => fake()->unique()->cpf(false),
            'name' => fake()->name(),
            'alias' => explode(' ', fake()->name())[0],
            'rg' => fake()->unique()->rg(false),
        ];
    }
}
