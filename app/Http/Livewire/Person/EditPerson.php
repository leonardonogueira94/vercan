<?php

namespace App\Http\Livewire\Person;

use App\Http\Requests\EditPersonRequest;
use App\Models\Person;
use Livewire\Component;

class EditPerson extends Component
{
    public bool $disableInputs = false;

    public Person $person;

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
    }

    public function render()
    {
        return view('livewire.person.edit-person');
    }
}
