<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\LegalPerson;
use App\Models\NaturalPerson;
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

    private array $personable = [
        LegalPerson::class,
        NaturalPerson::class
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $personableType = fake()->randomElement($this->personable);

        $addressIds = Address::pluck('id')->toArray();

        return [
            'personable_id' => $personableType::factory()->create(),
            'personable_type' => $personableType,
            'address_id' => fake()->randomElement($addressIds),
            'is_active' => fake()->boolean(85),
        ];
    }
}
