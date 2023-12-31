<?php

namespace Database\Factories;

use App\Enums\Contact\ContactChannel;
use App\Enums\Contact\ContactType;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contactIds = Contact::pluck('id')->toArray();

        $phoneTypes = ContactType::toCollection()->filter(fn($case) => in_array(ContactChannel::TELEFONE, $case->canais()));

        $chosenType = fake()->randomElement($phoneTypes);

        if($chosenType == 'cellphone')
            $phone = fake()->numerify('(##) #####-####');
        else
            $phone = fake()->numerify('(##) ####-####');

        return [
            'contact_id' => fake()->randomElement($contactIds),
            'phone' => $phone,
            'type' => $chosenType,
        ];
    }
}
