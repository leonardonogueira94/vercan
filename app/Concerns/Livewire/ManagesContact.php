<?php

namespace App\Concerns\Livewire;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Person;
use App\Models\Phone;

trait ManagesContact
{
    public ?array $contacts = [];

    public function addContact(bool $isDefault = false): void
    {
        if(!isset($this->contacts))
            return;

        $contact = [
            'index' => count($this->contacts),
            'is_default' => $isDefault,
            'is_registered' => false,
            'contact_name' => null,
            'company_name' => null,
            'job_title' => null,
            'emails' => [],
            'phones' => [],
        ];

        $this->contacts[] = $contact;

        $this->addEmail($contact['index']);

        $this->addPhone($contact['index']);
    }

    public function addEmail(int $contactIndex): void
    {
        $this->contacts[$contactIndex]['emails'][] = [
            'email' => '',
            'type' => '',
        ];
    }

    public function addPhone(int $contactIndex): void
    {
        $this->contacts[$contactIndex]['phones'][] = [
            'phone' => '',
            'type' => '',
        ];
    }

    public function removeContact(int $contactIndex): void
    {
        unset($this->contacts[$contactIndex]);

        $this->contacts = array_values($this->contacts);
    }

    public function removeEmail(int $contactIndex, int $emailIndex): void
    {
        unset($this->contacts[$contactIndex]['emails'][$emailIndex]);

        $this->contacts[$contactIndex]['emails'] = array_values($this->contacts[$contactIndex]['emails']);
    }

    public function removePhone(int $contactIndex, int $phoneIndex): void
    {
        unset($this->contacts[$contactIndex]['phones'][$phoneIndex]);

        $this->contacts[$contactIndex]['phones'] = array_values($this->contacts[$contactIndex]['phones']);
    }

    public function saveContacts(Person $person): void
    {
        foreach($this->contacts as $contact)
        {
            $createdContact = Contact::create([
                'person_id' => $person->id,
                'contact_name' => $contact['contact_name'],
                'company_name' => $contact['company_name'],
                'job_title' => $contact['job_title'],
                'is_default' => $contact['is_default'],
            ]);

            foreach($contact['phones'] as $phone)
                Phone::create([
                    'contact_id' => $createdContact->id,
                    'type' => $phone['type'],
                    'phone' => $phone['phone'],
                ]);

            foreach($contact['emails'] as $email)
                Email::create([
                    'contact_id' => $createdContact->id,
                    'type' => $email['type'],
                    'email' => $email['email'],
                ]);
        }
    }

    public function retrieveContacts(Person $person)
    {
        $personContacts = $person->contacts;

        $this->contacts = $personContacts->toArray();

        foreach($personContacts as $i => $contact)
        {
            $contact->emails->each(function($email) use($i){
                $this->contacts[$i]['emails'][] = $email->toArray();
            });

            $contact->phones->each(function($phone) use($i){
                $this->contacts[$i]['phones'][] = $phone->toArray();
            });
        }
    }

    public function updateContactsData(Person $person): void
    {
        $contactIds = [];
        $phoneIds = [];
        $emailIds = [];

        foreach($this->contacts as $contact)
        {
            $contact['id'] = Contact::updateOrCreate(['id' => $contact['id'] ?? null], [
                'person_id' => $person->id,
                'contact_name' => $contact['contact_name'],
                'company_name' => $contact['company_name'],
                'job_title' => $contact['job_title'],
                'is_default' => $contact['is_default'],
            ])->id;

            $contactIds[] = $contact['id'];

            foreach($contact['emails'] as $email)
            {
                $email['id'] = Email::updateOrCreate(['id' => $email['id'] ?? null], [
                    'contact_id' => $contact['id'],
                    'type' => $email['type'],
                    'email' => $email['email'],
                ])->id;

                $emailIds[] = $email['id'];
            }

            foreach($contact['phones'] as $phone)
            {
                $phone['id'] = Phone::updateOrCreate(['id' => $phone['id'] ?? null], [
                    'contact_id' => $contact['id'],
                    'type' => $phone['type'],
                    'phone' => $phone['phone'],
                ])->id;

                $phoneIds[] = $phone['id'];
            }

            $this->person->phones()->whereNotIn('phones.id', $phoneIds)->delete();
            $this->person->emails()->whereNotIn('emails.id', $emailIds)->delete();
            $this->person->contacts()->whereNotIn('contacts.id', $contactIds)->delete();
        }
    }
}