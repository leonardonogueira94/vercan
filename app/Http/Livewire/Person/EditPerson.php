<?php

namespace App\Http\Livewire\Person;

use App\Concerns\Livewire\ManagesContact;
use App\Concerns\Livewire\DeletesUnregisteredContact;
use App\Concerns\Livewire\FillsPersonField;
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
    use DeletesUnregisteredContact, FillsPersonField, ManagesContact;

    public Person $person;

    public bool $disableInputs = false;

    public Collection $ufs;

    public Collection $cities;

    protected function rules(): array
    {
        return (new EditPersonRequest($this->person))->rules();
    }

    public function mount(Person $person)
    {
        $this->person = $person;
        $this->ufs = City::groupBy('uf')->get();
        $this->cities = City::where('uf', $person->address?->city?->uf)->get();
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

        if($propertyName == 'person.address.city.uf')
        {
            $this->cities = City::where('uf', $value)->get();
        }
        
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

            return redirect()->route('person.show', ['person' => $this->person])->with('success', 'Pessoa atualizada com sucesso!');
            
        }catch(Exception $e){

            DB::rollBack();
            
            session()->flash('error', $e->getMessage());
        }
    }
    
    public function updateAddress()
    {
        $city = $this->person->address->city;
        $city = City::where(['uf' => $city->uf], ['name' => $city->name])->first();
        $this->person->address->city_id = $city->id;
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
