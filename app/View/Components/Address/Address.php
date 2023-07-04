<?php

namespace App\View\Components\Address;

use App\Models\Address as AddressModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Address extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?AddressModel $address,
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.address');
    }
}
