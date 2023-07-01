<?php

namespace App\Http\Livewire\Supplier;

use App\Enums\Contact\ContactType;
use App\Enums\Person\PersonStatus;
use App\Enums\Person\StateRegistrationCategory;
use App\Enums\Person\TaxCollectionType;
use App\Models\Email;
use App\Models\LegalPerson;
use App\Models\NaturalPerson;
use App\Models\Person;
use App\Models\Phone;
use App\Services\ReceitaService;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class ShowSupplier extends Component
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

            'emails.*.type' => [new Enum(ContactType::class)],
            'emails.*.email' => 'email',

            'phones.*.type' => [new Enum(ContactType::class)],
            'phones.*.phone' => 'digits:13',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if($propertyName == 'person.personable_type')
            $this->personable = new ($this->person->personable_type);
    }

    public function mount(Person $person)
    {
        $this->person = $person;
        $this->personable = $this->person->personable;
        $this->phones = $this->renameIdKeys($this->person->phones);
        $this->emails = $this->renameIdKeys($this->person->emails);
        if($this->phones->count() == 0)
            $this->phones->add(new Phone());
    }

    public function renameIdKeys(Collection $models)
    {
        return Phone::hydrate(array_map(function($model){
            $model['hiddenId'] = $model['id'];
            $model['id'] = null;
            return $model;
        }, $models->toArray()));
    }

    public function createEmail()
    {
        $this->newEmails->push(Email::make());
    }

    public function createPhone()
    {
        $phone = new Phone();

        $this->phones->push($phone);
    }

    public function render()
    {
        return view('livewire.supplier.show-supplier');
    }
}
