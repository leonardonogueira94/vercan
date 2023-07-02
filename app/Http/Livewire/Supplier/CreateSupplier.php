<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Address;
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
        $this->address = new Address();
        $this->personable = new LegalPerson();
        $this->phones = $this->person->phones;
        $this->emails = $this->person->emails;
        if($this->phones->count() == 0)
            $this->phones->add(new Phone());
        if($this->emails->count() == 0)
            $this->emails->add(new Email());
    }

    public function render()
    {
        return view('livewire.supplier.show-supplier');
    }
}
