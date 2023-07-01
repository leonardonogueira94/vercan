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
        return view('livewire.supplier.list-suppliers', ['people' => $this->applyQueryFilter($this->filter, Person::with('personable'))->paginate($this->perPage)]);
    }
}
