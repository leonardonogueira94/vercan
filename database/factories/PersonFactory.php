<?php

namespace Database\Factories;

use App\Enums\Person\PersonStatus;
use App\Enums\Person\PersonType;
use App\Enums\Person\StateRegistrationCategory;
use App\Enums\Person\TaxCollectionType;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $chosen = fake()->randomElement(PersonType::toArray());

        if($chosen == 'J')
            return [
                'type' => $chosen,
                'cnpj' => fake()->cnpj(true),
                'company_name' => fake()->company(),
                'trading_name' => fake()->company(),
                'ie_category' => fake()->randomElement(StateRegistrationCategory::toArray()),
                'ie' => fake()->numerify('#########'),
                'im' => fake()->numerify('###########'),
                'cnpj_status' => 'ATIVA',
                'tax_type' => fake()->randomElement(TaxCollectionType::toArray()),
                'is_active' => fake()->randomElement(PersonStatus::toArray()),
                'observation' => fake()->sentence(30),
            ];

        if($chosen == 'F')
            return [
                'type' => $chosen,
                'cpf' => fake()->unique()->cpf(true),
                'name' => fake()->name(),
                'alias' => explode(' ', fake()->name())[0],
                'rg' => fake()->unique()->rg(true),
                'is_active' => fake()->randomElement(PersonStatus::toArray()),
                'observation' => fake()->sentence(30),
            ];
    }
}
