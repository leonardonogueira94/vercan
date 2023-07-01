<?php

namespace Database\Factories;

use App\Enums\Contact\ContactType;
use App\Models\Contact;
use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contactIds = Contact::pluck('id')->toArray();

        return [
            'contact_id' => fake()->unique()->randomElement($contactIds),
            'email' => fake()->unique()->email(),
            'type' => fake()->randomElement(ContactType::toArray()),
        ];
    }
}
