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
use App\Services\ReceitaService;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class CreateSupplier extends Component
{
    private ReceitaService $receitaService;

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

    public function boot(
        ReceitaService $receitaService
    )
    {
        $this->receitaService = $receitaService;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if($propertyName == 'person.personable_type')
            $this->personable = new ($this->person->personable_type);

        if($propertyName == 'personable.cnpj' && strlen($this->personable->cnpj) == 14)
            $this->updatePersonData();
    }

    public function updatePersonData()
    {
        $data = $this->receitaService->getLegalPersonData($this->personable->cnpj);
        
        foreach($this->receitaService->getLegalPersonDataMap() as $column => $field)
            $this->personable->$column = $data->$field;
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
        $this->phones = $this->person->phones;
        $this->emails = $this->person->emails;
        if($this->phones->count() == 0)
            $this->phones->add(new Phone());
        if($this->emails->count() == 0)
            $this->emails->add(new Email());
    }

    public function render()
    {
        return view('livewire.supplier.show-supplier');
    }
}
