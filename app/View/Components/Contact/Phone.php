<?php

namespace App\View\Components\Contact;

use App\Enums\Contact\ContactChannel;
use App\Enums\Contact\ContactType;
use App\Models\Phone as PhoneModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Phone extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public PhoneModel $email,
        public int $index
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.phone');
    }
}
