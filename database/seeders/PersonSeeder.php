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
            $this->createAddressForPerson($person);
            $this->createContactWithPhoneAndEmail($person, true);
            $this->createContactWithPhoneAndEmail($person, false);
        });
    }

    public function createContactWithPhoneAndEmail(Person $person, bool $default)
    {
        $contact = $this->createContactForPerson($person, $default);
        $this->createEmailForContact($contact);
        $this->createPhoneForContact($contact);
    }

    public function createAddressForPerson(Person $person): Address
    {
        $address = Address::factory()->make();
        $address->person_id = $person->id;
        $address->save();
        return $address;
    }

    public function createContactForPerson(Person $person, bool $default = true): Contact
    {
        $contact = Contact::factory()->make();
        $contact->person_id = $person->id;
        $contact->is_default = $default;
        $contact->save();
        return $contact;
    }

    public function createPhoneForContact(Contact $contact): Phone
    {
        $phone = Phone::factory()->make();
        $phone->contact_id = $contact->id;
        $phone->save();
        return $phone;
    }

    public function createEmailForContact(Contact $contact): Email
    {
        $email = Email::factory()->make();
        $email->contact_id = $contact->id;
        $email->save();
        return $email;
    }
}