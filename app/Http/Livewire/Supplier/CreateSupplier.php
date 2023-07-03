<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Address;
use App\Models\LegalPerson;
use App\Models\Person;


class CreateSupplier extends Supplier
{
    public function mount(Person $person)
    {
        $this->person = $person;
        $this->person->personable_type = LegalPerson::class;
        $this->personable = new LegalPerson();
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
        return view('livewire.supplier.show-supplier');
    }
}
