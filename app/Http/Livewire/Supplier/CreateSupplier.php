<?php

namespace App\Http\Livewire\Supplier;

use App\Enums\Person\PersonStatus;
use App\Enums\Person\StateRegistrationCategory;
use App\Enums\Person\TaxCollectionType;
use App\Models\Email;
use App\Models\LegalPerson;
use App\Models\NaturalPerson;
use App\Models\Person;
use App\Models\Phone;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class CreateSupplier extends Component
{
    public Person $person;

    public Person $personable;

    public Collection $emails;

    public Collection $phones;

    protected function rules(): array 
    {
        return [
            'person.personable_type' => 'required|in:'.LegalPerson::class.','.NaturalPerson::class,
            'person.is_active' => ['required', new Enum(PersonStatus::class)],

            'personable.cnpj' => 'required|digits:14',
            'personable.company_name' => 'required|max:255',
            'personable.ie_category' => ['required', new Enum(StateRegistrationCategory::class)],
            'personable.ie' => [Rule::requiredIf($this->personable->ie_category?->required()), 'max:15'],
            'personable.tax_type' => ['required', new Enum(TaxCollectionType::class)],

            'personable.cpf' => 'required|max:11',
            'personable.name' => 'required|max:255',
            'personable.alias' => 'max:255',
            'personable.rg' => 'rquired|max:9',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if($propertyName == 'person.personable_type')
            $this->personable = new ($this->person->personable_type);
    }

    public function createEmail()
    {
        $this->emails->push(new Email());
    }

    public function createPhone()
    {
        $this->phones->push(new Phone());
    }

    public function mount()
    {
        $this->person = new Person();
        $this->person->personable_type = LegalPerson::class;
        $this->personable = new LegalPerson();
        $this->phones = $this->person?->phones;
        $this->emails = $this->person?->emails;
    }

    public function render()
    {
        return view('livewire.supplier.show-supplier');
    }
}
