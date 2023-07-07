<?php

namespace App\Http\Livewire\Person;

use App\Concerns\Livewire\ManagesContact;
use App\Concerns\Livewire\FillsPersonField;
use App\Enums\Person\PersonStatus;
use App\Enums\Person\PersonType;
use App\Enums\Person\StateRegistrationCategory;
use App\Http\Requests\EditPersonRequest;
use App\Models\City;
use App\Models\Person;
use App\Services\CepService;
use App\Services\MaskService;
use App\Services\ReceitaService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditPerson extends Component
{
    use FillsPersonField, ManagesContact;

    public ?Person $person;

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
        return (new EditPersonRequest(PersonType::tryFrom($this->type), StateRegistrationCategory::tryFrom($this->stateRegistrationCategory)))->rules();
    }

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

    public function submit()
    {        
        $this->validate();
        
        try{
            DB::beginTransaction();

            $person = $this->updatePersonData();

            $this->updateAddressData($this->person);

            $this->updateContactsData($this->person);

            DB::commit();

            return redirect()->route('person.show', ['person' => $this->person])->with('success', 'Pessoa atualizada com sucesso!');
            
        }catch(Exception $e){

            DB::rollBack();
            
            session()->flash('error', "{$e->getMessage()} | {$e->getFile()} | {$e->getLine()}");
        }
    }

    public function updatePersonData()
    {
        $this->person->update([
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
        ]);
    }

    public function updateAddressData(Person $person)
    {
        $city = City::where(['uf' => $this->uf], ['name' => $this->city])->first();

        $this->person->address->update([
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
