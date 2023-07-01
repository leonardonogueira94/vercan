<?php

namespace Database\Factories;

use App\Enums\Contact\ContactChannel;
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

        $emailTypes = ContactType::toCollection()->filter(fn($case) => in_array(ContactChannel::EMAIL, $case->canais()));

        return [
            'contact_id' => fake()->randomElement($contactIds),
            'email' => fake()->email(),
            'type' => fake()->randomElement($emailTypes),
        ];
    }
}
