<?php

namespace App\Http\Livewire\Person;

use App\Http\Requests\EditPersonRequest;
use App\Models\Email;
use App\Models\Person;
use Illuminate\Support\Collection;
use Livewire\Component;

class EditPerson extends Component
{
    public bool $disableInputs = false;

    public Person $person;

    public array $emails;

    public Collection $phones;

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
        $this->emails = [];
    }

    public function render()
    {
        return view('livewire.person.edit-person');
    }

    public function addEmail(int $contactId)
    {
        $email = [
            'contact_id' => $contactId,
            'type' => '',
            'email' => '',
        ];

        $this->emails[] = $email;
    }
}
