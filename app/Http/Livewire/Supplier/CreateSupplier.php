<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Email;
use App\Models\LegalPerson;
use App\Models\Person;
use App\Models\Phone;

class CreateSupplier extends Supplier
{
    public function mount(Person $person)
    {
        $this->person = $person;
        $this->person->personable_type = LegalPerson::class;
        $this->contacts = [];
        $this->createContact(false);
        $this->createContact(true);
        $this->emails = [];
        $this->createEmail(0);
        $this->createEmail(1);
        $this->phones = [];
        $this->createPhone(0);
        $this->createPhone(1);
        $this->address = new Address();
        $this->personable = new LegalPerson();
    }

    public function render()
    {
        return view('livewire.supplier.show-supplier');
    }
}
