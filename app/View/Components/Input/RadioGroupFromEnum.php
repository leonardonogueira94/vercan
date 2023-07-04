<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioGroupFromEnum extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $values,
        public ?string $default = null,
        public bool $wired = false,
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-group-from-enum');
    }
}
