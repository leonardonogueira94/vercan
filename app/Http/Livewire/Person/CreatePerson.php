<?php

namespace App\Http\Livewire\Person;

use App\Concerns\Livewire\ManagesContact;
use App\Concerns\Livewire\FillsPersonField;
use App\Enums\Person\PersonStatus;
use App\Enums\Person\PersonType;
use App\Enums\Person\StateRegistrationCategory;
use App\Http\Requests\CreatePersonRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Person;
use App\Services\CepService;
use App\Services\MaskService;
use App\Services\ReceitaService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CreatePerson extends Component
{
    use FillsPersonField, ManagesContact;

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

    public bool $disableInputs = false;

    protected function rules(): array
    {        
        return (new CreatePersonRequest(PersonType::tryFrom($this->type), StateRegistrationCategory::tryFrom($this->stateRegistrationCategory)))->rules();
    }

    public function mount(): void
    {
        $this->type = PersonType::JURIDICA->value;
        $this->stateRegistrationCategory = StateRegistrationCategory::CONTRIBUINTE->value;
        $this->ufs = City::groupBy('uf')->get();
        $this->uf = $this->ufs->first()?->uf;
        $this->cities = City::where('uf', $this->uf)->get();
        $this->addContact(true);
        $this->addContact();
    }

    public function boot(
        ReceitaService $receitaService,
        CepService $cepService,
        MaskService $maskService
    ): void
    {
        $this->receitaService = $receitaService;
        $this->cepService = $cepService;
        $this->maskService = $maskService;
    }

    public function updatingType(mixed $value): void
    {
        $value = PersonType::tryFrom($value);
    }

    public function resetForm()
    {
        if($this->type == PersonType::JURIDICA->value)
        {
            $this->cpf = null;
            $this->name = null;
            $this->alias = null;
        }

        if($this->type == PersonType::FISICA->value)
        {
            $this->cnpj = null;
            $this->companyName = null;
            $this->tradingName = null;
            $this->ie = null;
            $this->im = null;
            $this->cnpjStatus = null;
        }
    }

    public function render(): View
    {
        return view('livewire.person.create-person');
    }

    public function updated($propertyName, $value): void
    {
        $this->validateOnly($propertyName);

        if($propertyName == 'type')
            $this->resetForm();

        if($propertyName == 'uf')
        {
            $this->cities = City::where('uf', $this->uf)->get();
            $this->city = null;
        }

        if($propertyName == 'cnpj' && strlen($this->maskService->unmask($value)) == 14)
        {
            $this->fillPersonData($this->receitaService->getLegalPersonData($value));
            $this->fillAddress($this->cepService->getAddressDataByCep($this->maskService->unmask($this->cep)));
        }

        if($propertyName == 'cep' && strlen($this->maskService->unmask($value)) == 8)
            $this->fillAddress($this->cepService->getAddressDataByCep($this->maskService->unmask($this->cep)));
    }

    public function submit()
    {   
        $this->validate();
        
        try{
            DB::beginTransaction();

            $person = $this->savePerson();
            $this->saveContacts($person);
            $this->saveAddress($person);

            DB::commit();

            return redirect()->route('person.show', ['person' => $person])->with('success', 'Pessoa cadastrada com sucesso!');
            
        }catch(Exception $e){

            DB::rollBack();
            
            session()->flash('error', $e->getMessage());
        }
    }

    public function savePerson(): Person
    {
        $data = [
            'type' => $this->type,
            'cnpj' => $this->cnpj,
            'company_name' => $this->companyName,
            'trading_name' => $this->tradingName,
            'ie_category' => $this->stateRegistrationCategory,
            'ie' => $this->ie,
            'im' => $this->im,
            'cnpj_status' => $this->cnpjStatus,
            'tax_type' => $this->taxCollectionType,
            'cpf' => $this->cpf,
            'name' => $this->name,
            'alias' => $this->alias,
            'rg' => $this->rg,
            'is_active' => $this->personStatus,
            'observation' => $this->observation,
        ];

        foreach ($data as $key => $value)
        {
            if($value === '')
                $data[$key] = null;
        }

        return Person::create($data);
    }
    
    public function saveAddress(Person $person): Address
    {
        $city = City::where(['uf' => $this->uf], ['name' => $this->city])->first();

        return Address::create([
            'city_id' => $city->id,
            'person_id' => $person->id,
            'cep' => $this->cep,
            'address' => $this->address,
            'building_number' => $this->buildingNumber,
            'complement' => $this->complement,
            'area' => $this->area,
            'reference_point' => $this->referencePoint,
            'is_condo' => $this->isCondo,
        ]);
    }
}
