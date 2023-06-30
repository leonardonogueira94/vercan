<?php

namespace App\Http\Livewire\Supplier;

use Livewire\Component;

class CreateSupplier extends Component
{
    public function teste()
    {
        return dd('Isso eh um teste');
    }

    public function render()
    {
        return view('livewire.supplier.create-supplier');
    }
}
