<?php

namespace App\Http\Livewire\Person;

use App\Http\Livewire\Person\Person;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Person as PersonModel;
use App\Models\Phone;

class ShowPerson extends Person
{
    public function mount(PersonModel $person)
    {
        $this->person = $person;
        $this->personable = $this->person->personable;
        $this->contacts = $this->person->contacts->toArray() ?? [new Contact()];
        $this->phones = $this->person->phones->toArray() ?? [new Phone()];
        $this->emails = $this->person->emails->toArray() ?? [new Email()];
        $this->address = $this->person->address ?? new Address();
        /* $this->assignContactIndexes();
        $this->assignContactPhones();
        $this->assignContactEmails(); */
    }

    public function render()
    {
        return view('livewire.supplier.show-person');
    }
}
