<?php

namespace App\Http\Livewire\Person;

use App\Concerns\Livewire\ManagesContact;
use App\Concerns\Livewire\DeletesUnregisteredContact;
use App\Concerns\Livewire\DeletesUnregisteredPerson;
use App\Concerns\Livewire\FillsPersonField;
use App\Enums\Person\PersonStatus;
use App\Enums\Person\PersonType;
use App\Enums\Person\StateRegistrationCategory;
use App\Enums\Person\TaxCollectionType;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\EditPersonRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Person;
use App\Services\CepService;
use App\Services\MaskService;
use App\Services\ReceitaService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

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

    public ?StateRegistrationCategory $stateRegistrationCategory;

    public ?string $ie = '';

    public ?string $im = '';

    public ?string $cnpjStatus = '';
    
    public ?TaxCollectionType $taxCollectionType;

    public ?PersonStatus $personStatus = PersonStatus::ATIVA;

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
        return (new CreatePersonRequest(PersonType::tryFrom($this->type), $this->stateRegistrationCategory))->rules();
    }

    public function mount()
    {
        $this->type = PersonType::JURIDICA->value;
        $this->stateRegistrationCategory = StateRegistrationCategory::CONTRIBUINTE;
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
    ){
        $this->receitaService = $receitaService;
        $this->cepService = $cepService;
        $this->maskService = $maskService;
    }

    public function updatingType($value)
    {
        $value = PersonType::tryFrom($value);
    }

    public function resetForm()
    {
        $this->cnpj = null;
        $this->companyName = null;
        $this->tradingName = null;
        $this->ie = null;
        $this->im = null;
        $this->cnpjStatus = null;
        $this->cpf = null;
        $this->name = null;
        $this->alias = null;
    }

    public function render()
    {
        return view('livewire.person.create-person');
    }

    public function updated($propertyName, $value)
    {
        $this->validateOnly($propertyName);

        if($propertyName == 'uf')
            $this->cities = City::where('uf', $this->uf)->get();

        if($propertyName == 'person.cnpj' && strlen($this->maskService->unmask($value)) == 14)
        {
            $this->fillPersonData($this->receitaService->getLegalPersonData($value));
            $this->fillAddress($this->cepService->getAddressDataByCep($this->maskService->unmask($this->cep)));
        }

        if($propertyName == 'person.address.cep' && strlen($this->maskService->unmask($value)) == 8)
            $this->fillAddress($this->cepService->getAddressDataByCep($this->maskService->unmask($this->cep)));
    }

    public function submit()
    {   
        $this->validate();
        
        try{
            DB::beginTransaction();

            $this->person->save();
            $this->updateContacts();
            $this->updateAddress();

            DB::commit();

            return redirect()->route('person.show', ['person' => $this->person])->with('success', 'Pessoa cadastrada com sucesso!');
            
        }catch(Exception $e){

            DB::rollBack();
            
            session()->flash('error', $e->getMessage());
        }
    }
    
    public function updateAddress()
    {
        $this->person->address->city->save();
        $this->person->address->save();
    }

    public function updateContacts()
    {
        foreach($this->person->contacts as $contact)
        {
            $contact->is_registered = true;
            $contact->save();

            $contact->phones->each(function($email){
                $email->is_registered = true;
                $email->save();
            });

            $contact->emails->each(function($email){
                $email->is_registered = true;
                $email->save();
            });
        }
    }
}
