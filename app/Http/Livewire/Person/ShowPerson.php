<?php

namespace App\Http\Livewire\Person;

use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\ShowPersonRequest;
use App\Models\Person;
use Livewire\Component;

class ShowPerson extends Component
{
    public bool $disableInputs = true;

    public Person $person;

    public array $contacts;

    public array $phones;

    public array $emails;

    protected function rules(): array
    {
        return (new ShowPersonRequest($this->person))->rules();
    }

    public function mount(Person $person)
    {
        $this->person = $person;
        $this->contacts = [];
        $this->phones = [];
        $this->emails = [];
    }

    public function render()
    {
        return view('livewire.person.show-person');
    }
}
