<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Person;
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
            $contact->save();
        });
    }
}