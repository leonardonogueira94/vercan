<?php

namespace App\Http\Livewire\Person;

use App\Concerns\Livewire\ManagesContact;
use App\Concerns\Livewire\DeletesUnregisteredContact;
use App\Concerns\Livewire\DeletesUnregisteredPerson;
use App\Concerns\Livewire\FillsPersonField;
use App\Enums\Person\PersonStatus;
use App\Enums\Person\PersonType;
use App\Enums\Person\StateRegistrationCategory;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\EditPersonRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Person;
use App\Models\Phone;
use App\Services\CepService;
use App\Services\MaskService;
use App\Services\ReceitaService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreatePerson extends Component
{
    use DeletesUnregisteredPerson, FillsPersonField, ManagesContact;

    public Person $person;

    public Collection $ufs;

    public Collection $cities;

    public bool $disableInputs = false;

    protected function rules(): array
    {
        return (new CreatePersonRequest($this->person))->rules();
    }

    public function mount()
    {
        $this->person = Person::create(['is_registered' => false, 'type' => PersonType::JURIDICA->value, 'is_active' => PersonStatus::ATIVA->value]);
        $this->deleteUnregisteredPersons();
        $this->createDefaultAddress();
        $this->addContact(true);
        $this->refresh();
        $this->person->ie_category = StateRegistrationCategory::CONTRIBUINTE;
        $this->ufs = City::groupBy('uf')->get();
        $this->cities = City::where('uf', $this->person->address?->city?->uf)->get();
        $this->person = Person::find($this->person->id);
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

    public function createDefaultAddress()
    {
        Address::create([
            'person_id' => $this->person->id,
            'city_id' => City::first()->id,
            'cep' => '',
            'address' => '',
            'building_number' => '',
            'complement' => '',
            'area' => '',
            'reference_point' => '',
            'is_condo' => false,
        ]);
    }

    public function resetForm()
    {
        $this->person->cnpj = null;
        $this->person->company_name = null;
        $this->person->trading_name = null;
        $this->person->ie = null;
        $this->person->im = null;
        $this->person->cnpj_status = null;
        $this->person->cpf = null;
        $this->person->name = null;
        $this->person->alias = null;
        $this->person->observation = null;
        $this->person->rg = null;
        $this->person->rg = null;
        $this->person->rg = null;
    }

    public function render()
    {
        return view('livewire.person.create-person');
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
