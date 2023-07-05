<?php

namespace App\Http\Livewire\Person;

use App\Concerns\Livewire\DeletesUnregisteredContact;
use App\Models\Person;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DeletePerson extends Component
{
    public Person $person;

    public function render()
    {
        return view('livewire.person.delete-person');
    }

    public function mount(Person $person)
    {
        $this->delete($person);
    }

    public function delete(Person $person)
    {
        try{
            DB::beginTransaction();

            $this->person->phones()->delete();

            $this->person->emails()->delete();

            $this->person->contacts()->delete();

            $this->person->address()->delete();

            $this->person->delete();

            DB::commit();

            return redirect()->route('person.list')->with('success', 'Usuário excluído com sucesso!');

        }catch(Exception $e){
            
            DB::rollBack();

            session()->flash('error', $e->getMessage());
        }
    }
}
