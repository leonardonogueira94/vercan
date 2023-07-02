<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Person;
use App\Models\Phone;

class ShowSupplier extends Supplier
{
    public function mount(Person $person)
    {
        $this->person = $person;
        $this->personable = $this->person->personable;
        $this->contacts = $this->person->contacts->toArray() ?? [new Contact()];
        $this->phones = $this->person->phones->toArray() ?? [new Phone()];
        $this->emails = $this->person->emails->toArray() ?? [new Email()];
        $this->address = $this->person->address ?? new Address();
        $this->assignContactIndexes();
        $this->assignContactPhones();
        $this->assignContactEmails();
    }

    public function render()
    {
        return view('livewire.supplier.show-supplier');
    }
}
