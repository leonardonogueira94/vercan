<?php

namespace App\View\Components\DataTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionsButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $showRoute = '',
        public string $editRoute = '',
        public string $deleteRoute = '',
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.datatable.actions-button');
    }
}
