<?php

namespace App\Concerns;

use Livewire\WithPagination;

trait HasPagination
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $perPage = 100;

}