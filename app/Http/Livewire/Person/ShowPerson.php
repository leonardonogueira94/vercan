<?php

namespace App\Http\Livewire\Person;

use App\Concerns\Livewire\DeletesUnregisteredContact;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\ShowPersonRequest;
use App\Models\City;
use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowPerson extends Component
{
    use DeletesUnregisteredContact;

    public bool $disableInputs = true;

    public Person $person;

    public Collection $ufs;

    public Collection $cities;

    protected function rules(): array
    {
        return (new ShowPersonRequest($this->person))->rules();
    }

    public function mount(Person $person)
    {
        $this->person = $person;
        $this->ufs = City::groupBy('uf')->get();
        $this->cities = City::where('uf', $person->address?->city?->uf)->get();
        $this->deleteUnregisteredContacts();
    }

    public function render()
    {
        return view('livewire.person.show-person');
    }
}
