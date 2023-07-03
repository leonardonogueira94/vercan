<?php

namespace App\Http\Livewire\Person;

use App\Models\Address;
use App\Http\Livewire\Person\Person;
use App\Http\Requests\CreatePersonRequest;

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

    protected function rules(): array
    {
        return (new CreatePersonRequest())->rules();
    }

    public function render()
    {
        return view('livewire.supplier.create-person');
    }

    public function save()
    {
        $this->validate(); 
    }
}
