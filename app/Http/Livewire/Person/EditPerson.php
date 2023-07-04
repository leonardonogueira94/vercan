<?php

namespace App\Http\Livewire\Person;

use App\Http\Requests\EditPersonRequest;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Person;
use App\Models\Phone;
use App\Services\CepService;
use App\Services\MaskService;
use App\Services\ReceitaService;
use Livewire\Component;

class EditPerson extends Component
{
    private ReceitaService $receitaService;

    private CepService $cepService;

    private MaskService $maskService;

    public Person $person;

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

        $this->fillAddress($this->cepService->getAddressDataByCep($this->person->address->cep));
    }

    public function fillPersonData($addressData)
    {
        foreach($this->receitaService->getLegalPersonDataMap() as $column => $field)
            $this->person->$column = $addressData->$field;

        foreach($this->receitaService->getAddressDataMap() as $column => $field)
            $this->person->address->$column = $this->maskService->unmask($addressData->$field);
    }

    public function fillAddress($addressData)
    {        
        foreach($this->cepService->getAddressDataMap() as $column => $field)
            if(property_exists($addressData, $field) && !in_array($column, ['uf', 'city', 'cep']))
                $this->person->address->$column = $addressData->$field;

        $this->person->address->cep = $this->maskService->unmask($addressData->{$this->cepService->getAddressDataMap()['cep']});
        $this->person->address->city->uf = $addressData->{$this->cepService->getAddressDataMap()['uf']};
        $this->person->address->city->name = $addressData->{$this->cepService->getAddressDataMap()['city']};
    }

    public function mount(Person $person)
    {
        $this->person = $person;
        $this->person->phones()->where('phones.is_registered', false)->delete();
        $this->person->emails()->where('emails.is_registered', false)->delete();
        $this->person->contacts()->where('is_registered', false)->delete();
    }

    public function boot(
        ReceitaService $receitaService,
        CepService $cepService,
        MaskService $maskService
    ){
        $this->receitaService = $receitaService;
        $this->cepService = $cepService;
        $this->maskService = $maskService;
    }

    public function render()
    {
        return view('livewire.person.edit-person');
    }

    public function addContact()
    {
        $contact = Contact::create([
            'person_id' => $this->person->id,
            'is_default' => false,
            'is_registered' => false,
        ]);

        $this->addPhone($contact->id);

        $this->addEmail($contact->id);

        $this->person = Person::find($this->person->id);
    }

    public function addEmail(int $contactId)
    {
        $email = Email::create([
            'is_registered' => false,
            'contact_id' => $contactId,
        ]);

        $this->person = Person::find($this->person->id);
    }

    public function addPhone(int $contactId)
    {
        $phone = Phone::create([
            'is_registered' => false,
            'contact_id' => $contactId,
        ]);

        $this->person = Person::find($this->person->id);
    }

    public function removeContact($contactId)
    {
        $this->person->contacts()->where('id', $contactId)->delete();
    }

    public function removeEmail(int $emailId)
    {
        $this->person->emails()->where('id', $emailId)->delete();

    }

    public function removePhone(int $phoneId)
    {
        $this->person->phones()->where('id', $phoneId)->delete();
    }
}
