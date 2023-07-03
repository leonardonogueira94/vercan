<?php

namespace App\Http\Livewire\Person;

use App\Concerns\HasFilter;
use App\Concerns\HasPagination;
use App\Models\Person;
use Livewire\Component;

class ListPeople extends Component
{
    use HasPagination, HasFilter;

    public function render()
    {
        $builder = $this->applyQueryFilter($this->filter, Person::query());

        $people = $builder->paginate($this->perPage);

        return view('livewire.supplier.list-people', ['people' => $people]);
    }

    public function getPersonProperty()
    {
        $person = $this->person;

        $person->is_active = $this->getIsActiveAttribute($person->is_active);
    }
}
