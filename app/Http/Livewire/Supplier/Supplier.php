<?php

namespace App\Http\Livewire\Supplier;

use App\Enums\Contact\ContactType;
use App\Enums\Person\PersonStatus;
use App\Enums\Person\StateRegistrationCategory;
use App\Enums\Person\TaxCollectionType;
use App\Models\Address;
use App\Models\City;
use App\Models\Contact;
use App\Models\Email;
use App\Models\LegalPerson;
use App\Models\NaturalPerson;
use App\Models\Person;
use App\Models\Phone;
use App\Models\State;
use App\Services\ReceitaService;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class Supplier extends Component
{
    private ReceitaService $receitaService;

    public Person $person;

    public Person $personable;

    public array $contacts;

    public array $phones;

    public array $emails;

    public Address $address;

    public State $state;

    public City $city;

    protected function rules(): array 
    {
        return [
            'person.personable_type' => 'required|in:'.LegalPerson::class.','.NaturalPerson::class,
            'person.is_active' => ['required', new Enum(PersonStatus::class)],

            'personable.cnpj' => 'required|digits:14',
            'personable.cnpj_status' => 'max:20',
            'personable.company_name' => 'required|max:255',
            'personable.trading_name' => 'required|max:255',
            'personable.ie_category' => ['required', new Enum(StateRegistrationCategory::class)],
            'personable.ie' => [Rule::requiredIf($this->personable->ie_category?->required()), 'max:15'],
            'personable.im' => 'max:15',
            'personable.tax_type' => ['required', new Enum(TaxCollectionType::class)],

            'personable.cpf' => 'required|max:11',
            'personable.name' => 'required|max:255',
            'personable.alias' => 'max:255',
            'personable.rg' => 'rquired|max:9',

            'emails.*.type' => [new Enum(ContactType::class)],
            'emails.*.email' => 'email',

            'phones.*.type' => [new Enum(ContactType::class)],
            'phones.*.phone' => 'digits:13',

            'address.cep' => 'required|digits:8',
            'address.street' => 'required|max:255',
            'address.number' => 'required|max:15',
            'address.complement' => 'max:255',
            'address.area' => 'required|max:255',
            'address.reference_point' => 'max:255',

            'contacts.*.contact_name' => 'max:5',
            'contacts.*.company_name' => 'max:5',
            'contacts.*.job_title' => 'max:5',
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
            $this->personable[$column] = $data->$field;

        foreach($this->receitaService->getAddressDataMap() as $column => $field)
            $this->personable[$column] = $data->$field;
    }

    /* public function assignContactIndexes()
    {
        foreach($this->contacts as $index => &$contact)
            $contact['index'] = $index;
    }

    public function assignContactEmails()
    {
        foreach($this->emails as &$email)
        {
            $email['contact'] = null;

            foreach($this->contacts as &$contact)
            {
                if($email['contact_id'] == $contact['id'])
                {
                    $email['contact'] = $contact;

                    $contact['emails'][] = $email;
                }
            }
        }
    }

    public function assignContactPhones()
    {
        foreach($this->phones as &$phone)
        {
            $phone['contact'] = null;

            foreach($this->contacts as &$contact)
            {
                if($phone['contact_id'] == $contact['id'])
                {
                    $phone['contact'] = $contact;

                    $contact['phones'][] = $phone;
                }
            }
        }
    } */

    public function createEmail(int $contactIndex = 0, string $value = null, string $type = null)
    {
        $contact = $this->contacts[$contactIndex];

        $email = (new Email())->toArray();

        $email['contact'] = $contact;

        $email['type'] = $type;

        $email['email'] = $value;

        $email['index'] = isset($this->emails) ? count($this->emails) : 0;

        $this->emails[] = $email;
    }

    public function createPhone(int $contactIndex = 0, string $value = null, string $type = null)
    {
        $contact = $this->contacts[$contactIndex];

        $phone = (new Phone())->toArray();

        $phone['contact'] = $contact;

        $phone['type'] = $type;

        $phone['phone'] = $value;

        $phone['index'] = isset($this->phones) ? count($this->phones) : 0;

        $this->phones[] = $phone;
    }

    public function createContact(bool $isDefault = false)
    {
        $contact = (new Contact())->toArray();

        $contact['is_default'] = $isDefault;

        $contact['contact_name'] = null;

        $contact['company_name'] = null;

        $contact['job_title'] = null;

        if(!isset($this->contacts))
            $contact['index'] = 0;

        if(isset($this->contacts))
            $contact['index'] = count($this->contacts);

        $this->contacts[] = $contact;

        $this->createEmail($contact['index']);

        $this->createPhone($contact['index']);
    }

    public function removePhone(int $phoneIndex = 0)
    {
        unset($this->phones[$phoneIndex]);

        $this->phones[] = array_values($this->phones);
    }

    public function removeEmail(int $emailIndex = 0)
    {
        unset($this->emails[$emailIndex]);

        $this->emails[] = array_values($this->emails);
    }

    public function removeContact(int $contactIndex = 0)
    {
        unset($this->contacts[$contactIndex]);

        $this->contacts = array_values($this->contacts);
    }
}