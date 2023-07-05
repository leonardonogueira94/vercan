<?php

namespace App\Concerns\Livewire;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Person;
use App\Models\Phone;

trait ManagesContact
{
    public function addContact($isDefault = false)
    {
        $contact = Contact::create([
            'person_id' => $this->person->id,
            'is_default' => $isDefault,
            'is_registered' => false,
        ]);

        $this->addPhone($contact->id);

        $this->addEmail($contact->id);

        $this->propertyChanged('person');
    }

    public function addEmail(int $contactId)
    {
        Email::create([
            'is_registered' => false,
            'contact_id' => $contactId,
        ]);

        $this->propertyChanged('person');
    }

    public function addPhone(int $contactId)
    {
        Phone::create([
            'is_registered' => false,
            'contact_id' => $contactId,
        ]);

        $this->propertyChanged('person');
    }

    public function removeContact($contactId)
    {
        $this->person->phones()->where('contact_id', $contactId)->delete();
        $this->person->emails()->where('contact_id', $contactId)->delete();
        $this->person->contacts()->where('id', $contactId)->delete();

        $this->propertyChanged('person');
    }

    public function removeEmail(int $emailId)
    {
        $this->person->emails()->where('emails.id', $emailId)->delete();

        $this->propertyChanged('person');
    }

    public function removePhone(int $phoneId)
    {
        $this->person->phones()->where('phones.id', $phoneId)->delete();

        $this->propertyChanged('person');
    }

    public function refresh()
    {
        $this->propertyChanged('person');
    }

}