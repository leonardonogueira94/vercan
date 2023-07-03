<?php

namespace App\Http\Livewire\Person;

use App\Models\Address;
use App\Http\Livewire\Person\Person;

class CreatePerson extends Person
{
    public function mount(Person $person)
    {
        $this->person = $person;
        $this->personable = '';
        $this->contacts = [];
        $this->createContact(true);
        $this->address = new Address();
    }

    public function hydrateContacts($contacts)
    {
        return (array) $contacts;
    }

    public function dehydrateContacts($contacts)
    {
        return (array) $contacts;
    }

    public function render()
    {
        return view('livewire.supplier.create-person');
    }
}
