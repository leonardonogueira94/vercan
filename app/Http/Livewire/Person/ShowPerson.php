<?php

namespace App\Http\Livewire\Person;

use App\Http\Requests\CreatePersonRequest;
use App\Models\Person;
use Livewire\Component;

class ShowPerson extends Component
{
    public bool $disableInputs = true;

    public Person $person;

    protected function rules(): array
    {
        return (new CreatePersonRequest($this->person))->rules();
    }

    public function mount(Person $person)
    {
        $this->person = $person;
    }

    public function render()
    {
        return view('livewire.person.show-person');
    }
}
