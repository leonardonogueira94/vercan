<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cityIds = City::pluck('id')->toArray();

        $places = ['Gas Station', 'Liquor Store', 'Grocery Store'];

        return [
            'city_id' => fake()->randomElement($cityIds),
            'cep' => fake()->postcode(),
            'address' => fake()->streetSuffix() . ' ' . fake()->streetName(),
            'building_number' => fake()->buildingNumber(),
            'complement' => fake()->secondaryAddress(),
            'area' => fake()->citySuffix(),
            'reference_point' => 'Near the ' . fake()->randomElement($places),
            'is_condo' => fake()->boolean(40),
        ];
    }
}
