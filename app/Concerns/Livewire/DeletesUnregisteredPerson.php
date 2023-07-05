<?php

namespace App\Concerns\Livewire;

use App\Models\Person;

trait DeletesUnregisteredPerson
{
    public function deleteUnregisteredPersons(){
        $people = Person::where('is_registered', false);
        
        foreach($people as $person)
        {
            $person->phones()->delete();
            $person->emails()->delete();
            $person->contacts()->delete();
            $person->address()->delete();
        }
    }
}