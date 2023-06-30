<?php

namespace App\View\Components\DataTable;

use Closure;
use Countable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $headers,
        public array $columns,
        public array|Countable $rows
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.datatable.datatable');
    }
}
