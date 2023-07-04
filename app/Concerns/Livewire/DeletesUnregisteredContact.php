<?php

namespace App\Concerns\Livewire;

trait DeletesUnregisteredContact
{
    public function deleteUnregisteredContacts(){
        $this->person->phones()->where('phones.is_registered', false)->delete();
        $this->person->emails()->where('emails.is_registered', false)->delete();
        $this->person->contacts()->where('is_registered', false)->delete();
    }
}