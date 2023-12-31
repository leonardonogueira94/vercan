<?php

namespace App\View\Components\Contact;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Email extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public object $email,
        public int $contactIndex,
        public int $emailIndex
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.email');
    }
}
