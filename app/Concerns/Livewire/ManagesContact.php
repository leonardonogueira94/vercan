<?php

namespace App\Concerns\Livewire;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Person;
use App\Models\Phone;
use stdClass;

trait ManagesContact
{
    public ?array $contacts = [];

    public function addContact($isDefault = false)
    {
        if(!isset($this->contacts))
            return;

        $contact = [
            'index' => count($this->contacts),
            'is_default' => $isDefault,
            'is_registered' => false,
            'contact_name' => '',
            'company_name' => '',
            'job_title' => '',
            'emails' => [],
            'phones' => [],
        ];

        $this->contacts[] = $contact;

        $this->addEmail($contact['index']);

        $this->addPhone($contact['index']);
    }

    public function addEmail(int $contactIndex)
    {
        $this->contacts[$contactIndex]['emails'][] = [
            'email' => '',
            'type' => '',
        ];
    }

    public function addPhone(int $contactIndex)
    {
        $this->contacts[$contactIndex]['phones'][] = [
            'phone' => '',
            'type' => '',
        ];
    }

    public function removeContact(int $contactIndex)
    {
        unset($this->contacts[$contactIndex]);

        $this->contacts = array_values($this->contacts);
    }

    public function removeEmail(int $contactIndex, int $emailIndex)
    {
        unset($this->contacts[$contactIndex]['emails'][$emailIndex]);

        $this->contacts[$contactIndex]['emails'] = array_values($this->contacts[$contactIndex]['emails']);
    }

    public function removePhone(int $contactIndex, int $phoneIndex)
    {
        unset($this->contacts[$contactIndex]['phones'][$phoneIndex]);

        $this->contacts[$contactIndex]['phones'] = array_values($this->contacts[$contactIndex]['phones']);
    }
}