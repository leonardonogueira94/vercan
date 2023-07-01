<?php

namespace App\View\Components\DataTable;

use App\View\Components\DataTable\DataTable;
use Closure;
use Illuminate\Contracts\View\View;

class PersonDataTable extends DataTable
{
    public function render(): View|Closure|string
    {
        return view('components.datatable.person-datatable');
    }
}
