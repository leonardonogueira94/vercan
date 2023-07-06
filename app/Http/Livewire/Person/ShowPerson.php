<?php

namespace App\Http\Livewire\Person;

use App\Concerns\Livewire\FillsPersonField;
use App\Concerns\Livewire\ManagesContact;
use App\Enums\Person\PersonStatus;
use App\Enums\Person\PersonType;
use App\Enums\Person\StateRegistrationCategory;
use App\Models\City;
use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowPerson extends Component
{
    use FillsPersonField, ManagesContact;

    public Person $person;

    public string $type = PersonType::JURIDICA->value;

    public ?string $cnpj = '';

    public ?string $cpf = '';

    public ?string $companyName = '';

    public ?string $name = '';

    public ?string $tradingName = '';

    public ?string $alias = '';

    public ?string $rg = '';

    public ?string $stateRegistrationCategory = StateRegistrationCategory::CONTRIBUINTE->value;

    public ?string $ie = '';

    public ?string $im = '';

    public ?string $cnpjStatus = '';
    
    public ?string $taxCollectionType = '';

    public ?string $personStatus = PersonStatus::ATIVA->value;

    public ?string $cep = '';

    public ?string $address = '';

    public ?string $buildingNumber = '';

    public ?string $complement = '';

    public ?string $area = '';

    public ?string $referencePoint = '';

    public ?string $uf = '';

    public ?string $city = '';

    public ?int $isCondo = 0;

    public ?string $observation = '';

    public Collection $ufs;

    public Collection $cities;

    public bool $disableInputs = true;

    public function mount(Person $person)
    {
        $this->person = $person;
        $this->type = $person->type;
        $this->cnpj = $person->cnpj;
        $this->companyName = $person->company_name;
        $this->tradingName = $person->trading_name;
        $this->stateRegistrationCategory = $person->ie_category;
        $this->ie = $person->ie;
        $this->im = $person->im;
        $this->cnpjStatus = $person->cnpj_status;
        $this->taxCollectionType = $person->tax_type;
        $this->personStatus = $person->is_active;
        $this->cpf = $person->cpf;
        $this->name = $person->name;
        $this->alias = $person->alias;
        $this->rg = $person->rg;
        $this->cep = $person->address->cep;
        $this->address = $person->address->address;
        $this->buildingNumber = $person->address->building_number;
        $this->complement = $person->address->complement;
        $this->area = $person->address->area;
        $this->referencePoint = $person->address->reference_point;
        $this->uf = $person->address->city->uf;
        $this->city = $person->address->city->name;
        $this->isCondo = $person->address->is_condo;
        $this->observation = $person->observation;
        $this->ufs = City::groupBy('uf')->get();
        $this->cities = City::where('uf', $this->uf)->get();
        $this->retrieveContacts($person);
    }

    public function retrieveContacts(Person $person)
    {
        $personContacts = $person->contacts;

        $this->contacts = $personContacts->toArray();

        foreach($personContacts as $i => $contact)
        {
            $this->contacts[$i]['emails'] = $contact->emails;
            $this->contacts[$i]['phones'] = $contact->phones;
        }
    }

    public function render()
    {
        return view('livewire.person.show-person', ['person' => $this->person]);
    }
}
