<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Person;
use App\Models\Phone;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        Person::factory()
        ->count(30)
        ->create()
        ->each(function($person){ 
            $address = Address::factory()->make();
            $address->person_id = $person->id;
            $address->save();
            
            $contact = Contact::factory()->make();
            $contact->person_id = $person->id;
            $contact->is_default = true;
            $contact->save();

            $email = Email::factory()->make();
            $email->contact_id = $contact->id;
            $email->save();

            $phone = Phone::factory()->make();
            $phone->contact_id = $contact->id;
            $phone->save();
        });
    }
}