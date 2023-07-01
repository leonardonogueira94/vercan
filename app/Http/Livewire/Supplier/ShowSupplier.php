<?php

namespace App\Http\Livewire\Supplier;

use App\Enums\Person\PersonType;
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
            'person.personable_type' => ['required', new Enum(PersonType::class)],
        ];
    }

    public function mount()
    {
        $this->person = new Person();
    }

    public function render()
    {
        return view('livewire.supplier.show-supplier');
    }
}
