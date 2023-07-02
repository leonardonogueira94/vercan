<?php

namespace App\Http\Livewire\Supplier;

use App\Concerns\HasFilter;
use App\Concerns\HasPagination;
use App\Models\Person;
use Livewire\Component;

class ListSuppliers extends Component
{
    use HasPagination, HasFilter;

    public function render()
    {
        $builder = $this->applyQueryFilter($this->filter, Person::with('personable'));

        $builder = $this->applyQueryFilterOnRelation($this->filter, ['legal_people', 'natural_people'], 'personable', $builder);

        $people = $builder->paginate($this->perPage);

        return view('livewire.supplier.list-suppliers', ['people' => $people]);
    }
}
