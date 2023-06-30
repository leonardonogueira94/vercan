<?php

namespace Database\Factories;

use App\Enums\Person\StateRegistrationCategory;
use App\Enums\Person\TaxCollectionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class LegalPersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cnpj' => fake()->cnpj(false),
            'company_name' => fake()->company(),
            'trading_name' => fake()->company(),
            'ie_category' => fake()->randomElement(StateRegistrationCategory::toArray()),
            'ie' => fake()->numerify('#########'),
            'im' => fake()->numerify('###########'),
            'tax_type' => fake()->randomElement(TaxCollectionType::toArray()),
            'created_at' => now(),
        ];
    }
}
