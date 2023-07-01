<?php

namespace Database\Factories;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stateIds = State::pluck('id')->toArray();

        return [
            'state_id' => fake()->randomElement($stateIds),
            'name' => fake()->unique()->city,
        ];
    }
}
