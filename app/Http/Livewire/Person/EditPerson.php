<?php

namespace App\Http\Livewire\Person;

use App\Http\Requests\EditPersonRequest;
use App\Models\Person;
use App\Services\CepService;
use App\Services\ReceitaService;
use Livewire\Component;

class EditPerson extends Component
{
    private ReceitaService $receitaService;

    private CepService $cepService;

    public Person $person;

    public array $contacts;

    public array $phones;

    public array $emails;

    public bool $disableInputs = false;

    protected function rules(): array
    {
        return (new EditPersonRequest($this->person))->rules();
    }

    public function updated($propertyName, $value)
    {
        $this->validateOnly($propertyName);

        if($propertyName == 'person.cnpj' && strlen($value) == 14)
            $this->fillPersonData($this->receitaService->getLegalPersonData($value));

        if($propertyName == 'person.address.cep' && strlen($value) == 8)
            $this->fillAddress($this->cepService->getAddressDataByCep($value));
    }

    public function fillPersonData($addressData)
    {
        foreach($this->receitaService->getLegalPersonDataMap() as $column => $field)
            $this->person->$column = $addressData->$field;
    }

    public function fillAddress($addressData)
    {        
        foreach($this->cepService->getAddressDataMap() as $column => $field)
            if(property_exists($addressData, $field) && !in_array($column, ['uf', 'city']))
                $this->person->address->$column = $addressData->$field;

        $this->person->address->city->uf = $addressData->{$this->cepService->getAddressDataMap()['uf']};
        $this->person->address->city->name = $addressData->{$this->cepService->getAddressDataMap()['city']};
    }

    public function mount(Person $person)
    {
        $this->person = $person;
        $this->contacts = [];
        $this->phones = [];
        $this->emails = [];
        $this->markContacts();
    }

    public function boot(
        ReceitaService $receitaService,
        CepService $cepService
    ){
        $this->receitaService = $receitaService;
        $this->cepService = $cepService;
    }

    public function render()
    {
        return view('livewire.person.edit-person');
    }

    public function markContacts()
    {
        foreach($this->person->contacts as $contactIndex => $contact)
        {
            $contact->index = $contactIndex;
            
            foreach($contact->phones as $phoneIndex => $phone)
            {
                $phone->index = $phoneIndex;
                $phone->exists = true;
                $phone->contact_index = $contactIndex;
            }

            foreach($contact->emails as $emailIndex => $email)
            {
                $email->index = $emailIndex;
                $email->exists = true;
                $email->contact_index = $contactIndex;
            }
        }
    }

    public function addContact()
    {
        $contact = [
            'id' => fake()->numerify('########'),
            'is_default' => false,
            'contact_name' => '',
            'company_name' => '',
            'job_title' => '',
        ];

        $this->addPhone($contact['id']);

        $this->addEmail($contact['id']);

        $this->contacts[] = $contact;
    }

    public function addEmail(int $contactId)
    {
        $email = [
            'contact_id' => $contactId,
            'index' => count($this->emails),
            'contact_index' => $this->getContactIndex($contactId),
            'exists' => false,
            'type' => '',
            'email' => '',
        ];

        $this->emails[] = $email;
    }

    public function addPhone(int $contactId)
    {
        $phone = [
            'contact_id' => $contactId,
            'index' => count($this->phones),
            'contact_index' => $this->getContactIndex($contactId),
            'exists' => false,
            'type' => '',
            'phone' => '',
        ];

        $this->phones[] = $phone;
    }

    public function getContactIndex(int $contactId)
    {
        foreach($this->person->contacts as $index => $contact)
            if($contact->id == $contactId)
                return $index;

        foreach($this->contacts as $index => $contact)
            if($contact['id'] == $contactId)
                return $index;
    }
}
