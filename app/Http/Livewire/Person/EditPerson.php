<?php

namespace App\Http\Livewire\Person;

use App\Concerns\Livewire\ManagesContact;
use App\Concerns\Livewire\DeletesUnregisteredContact;
use App\Concerns\Livewire\FillsPersonField;
use App\Http\Requests\EditPersonRequest;
use App\Models\Person;
use App\Services\CepService;
use App\Services\MaskService;
use App\Services\ReceitaService;
use Livewire\Component;

class EditPerson extends Component
{
    use DeletesUnregisteredContact, FillsPersonField, ManagesContact;

    public Person $person;

    public bool $disableInputs = false;

    protected function rules(): array
    {
        return (new EditPersonRequest($this->person))->rules();
    }

    public function mount(Person $person)
    {
        $this->person = $person;
        $this->deleteUnregisteredContacts();
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

    public function updated($propertyName, $value)
    {
        $this->validateOnly($propertyName);

        if($propertyName == 'person.cnpj' && strlen($this->maskService->unmask($value)) == 14)
        {
            $this->fillPersonData($this->receitaService->getLegalPersonData($value));
            $this->fillAddress($this->cepService->getAddressDataByCep($this->maskService->unmask($this->person->address->cep)));
        }

        if($propertyName == 'person.address.cep' && strlen($this->maskService->unmask($value)) == 8)
            $this->fillAddress($this->cepService->getAddressDataByCep($this->maskService->unmask($this->person->address->cep)));
    }

    
}
