<?php

namespace App\View\Components\Contact;

use App\Enums\Contact\ContactChannel;
use App\Enums\Contact\ContactType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Contact extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $company,
        public string $readonlyle,
        public string $value,
        public bool $readonly,
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact');
    }
}
