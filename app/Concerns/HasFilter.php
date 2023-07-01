<?php

namespace App\Concerns;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasFilter
{
    public string $filter = '';

    public function applyQueryFilter(string $filter, Builder $query): Builder
    {
        //$query->where($filter, 'LIKE', "%$filter%");

        return $query;
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }
}

