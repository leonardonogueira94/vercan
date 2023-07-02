<?php

namespace App\Http\Livewire\Supplier;

use App\Enums\Contact\ContactType;
use App\Enums\Person\PersonStatus;
use App\Enums\Person\StateRegistrationCategory;
use App\Enums\Person\TaxCollectionType;
use App\Models\Address;
use App\Models\Contact;
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

class Supplier extends Component
{
    private ReceitaService $receitaService;

    public Person $person;

    public Person $personable;

    public Collection $contacts;

    public Collection $phones;

    public array $emails;

    public Address $address;

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

        foreach($this->receitaService->getAddressDataMap() as $column => $field)
            $this->personable->$column = $data->$field;
        
    }

    public function mount(Person $person)
    {
        $this->person = $person;
        $this->personable = $this->person->personable;
        $this->contacts = $this->person->contacts ?? collect([new Contact()]);
        $this->phones = collect([]);
        $this->emails = collect([]);
        $this->address = $this->person->address ?? new Address();
    }

    public function createEmail(int $contactIndex)
    {
        $contact = $this->contacts->offsetGet($contactIndex);

        $email = new Email();

        $email['contact'] = $contact;

        $this->emails[] = $email;
    }

    public function createPhone(int $contactIndex)
    {
        $contact = $this->contacts->offsetGet($contactIndex);

        $phone = new Phone();

        $phone->contact = $contact;

        $this->phones->add($phone);
    }

    public function createContact(bool $isDefault = false)
    {
        $contact = new Contact();

        $contact->is_default = $isDefault;

        if(!isset($this->contacts))
            $contact->index = 0;

        if(isset($this->contacts))
            $contact->index = $this->contacts->count();

        $this->contacts[] = $contact;
    }
}