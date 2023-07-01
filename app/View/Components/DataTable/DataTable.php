<?php

namespace App\View\Components\DataTable;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public LengthAwarePaginator $rows,
        public array $headers = [],
        public array $columns = [],
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.datatable.datatable');
    }
}
