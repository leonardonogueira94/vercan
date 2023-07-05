<?php

namespace App\Concerns\Livewire;

use App\Models\Person;

trait DeletesUnregisteredContact
{
    public function deleteUnregisteredContacts(){
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