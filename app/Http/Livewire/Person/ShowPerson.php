<?php

namespace App\Http\Livewire\Person;

use App\Concerns\Livewire\DeletesUnregisteredContact;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\ShowPersonRequest;
use App\Models\Person;
use Livewire\Component;

class ShowPerson extends Component
{
    use DeletesUnregisteredContact;

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
        $this->deleteUnregisteredContacts();
    }

    public function render()
    {
        return view('livewire.person.show-person');
    }
}
