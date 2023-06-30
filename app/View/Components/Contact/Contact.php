<?php

namespace App\View\Components\Contato;

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
        public ContactType $type,
        public ContactChannel $channel,
        public string $company,
        public string $role,
        public string $value
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact');
    }
}
