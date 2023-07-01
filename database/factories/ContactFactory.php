<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $personIds = Person::pluck('id')->toArray();

        return [
            'person_id' => fake()->randomElement($personIds),
            'contact_name' => fake()->name(),
            'company_name' => fake()->company(),
            'job_title' => fake()->jobTitle(),
            'is_default' => fake()->boolean(60),
        ];
    }
}
