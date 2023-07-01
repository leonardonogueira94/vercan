<?php

namespace App\Http\Livewire\Supplier;

use App\Enums\Person\PersonType;
use App\Models\LegalPerson;
use App\Models\NaturalPerson;
use App\Models\Person;
use Livewire\Component;

class ShowSupplier extends Component
{
    public Person $person;

    public Person $personable;

    protected function rules(): array 
    {
        return [
            'person.personable_type' => 'required|in:'.LegalPerson::class.','.NaturalPerson::class,
        ];
    }

    public function updated($propertyName)
    {
        if($propertyName == 'person.personable_type')
            $this->personable = new ($this->person->personable_type);
    }

    public function mount()
    {
        $this->person = new Person();
        $this->person->personable_type = LegalPerson::class;
    }

    public function render()
    {
        return view('livewire.supplier.show-supplier');
    }
}
