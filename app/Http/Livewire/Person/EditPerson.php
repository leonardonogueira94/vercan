<?php

namespace App\Http\Livewire\Person;

use App\Http\Requests\EditPersonRequest;
use App\Models\Contact;
use App\Models\Person;
use Livewire\Component;

class EditPerson extends Component
{
    public bool $disableInputs = false;

    public Person $person;

    public array $contacts;

    public array $phones;

    public array $emails;

    protected function rules(): array
    {
        return (new EditPersonRequest($this->person))->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(Person $person)
    {
        $this->person = $person;
        $this->contacts = [];
        $this->phones = [];
        $this->emails = [];
        $this->markContacts();
    }

    public function render()
    {
        return view('livewire.person.edit-person');
    }

    public function markContacts()
    {
        foreach($this->person->contacts as $contactIndex => $contact)
        {
            $contact->index = $contactIndex;
            
            foreach($contact->phones as $phoneIndex => $phone)
            {
                $phone->index = $phoneIndex;
                $phone->exists = true;
                $phone->contact_index = $contactIndex;
            }

            foreach($contact->emails as $emailIndex => $email)
            {
                $email->index = $emailIndex;
                $email->exists = true;
                $email->contact_index = $contactIndex;
            }
        }
    }

    public function addContact()
    {
        $contact = [
            'id' => fake()->numerify('########'),
            'is_default' => false,
            'contact_name' => '',
            'company_name' => '',
            'job_title' => '',
        ];

        $this->addPhone($contact['id']);

        $this->addEmail($contact['id']);

        $this->contacts[] = $contact;
    }

    public function addEmail(int $contactId)
    {
        $email = [
            'contact_id' => $contactId,
            'type' => '',
            'email' => '',
        ];

        $this->emails[] = $email;
    }

    public function addPhone(int $contactId)
    {
        $phone = [
            'contact_id' => $contactId,
            'type' => '',
            'phone' => '',
        ];

        $this->phones[] = $phone;
    }
}
