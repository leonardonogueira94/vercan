<?php

namespace App\View\Components\Contact;

use App\Enums\Contact\ContactChannel;
use App\Enums\Contact\ContactType;
use App\Models\Contact as ContactModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Contact extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $contactIndex,
        public ContactModel|array $contact,
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact');
    }
}
