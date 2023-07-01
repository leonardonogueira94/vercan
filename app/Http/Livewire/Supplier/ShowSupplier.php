<?php

namespace App\Http\Livewire\Supplier;

use App\Enums\Person\StateRegistrationCategory;
use App\Models\LegalPerson;
use App\Models\NaturalPerson;
use App\Models\Person;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class ShowSupplier extends Component
{
    public Person $person;

    public Person $personable;

    protected function rules(): array 
    {
        return [
            'person.personable_type' => 'required|in:'.LegalPerson::class.','.NaturalPerson::class,
            'personable.ie_category' => ['required', new Enum(StateRegistrationCategory::class)],
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
        $this->personable = new LegalPerson();
    }

    public function render()
    {
        return view('livewire.supplier.show-supplier');
    }
}
