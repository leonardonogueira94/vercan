<?php

namespace App\Concerns;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait HasFilter
{
    public string $filter = '';

    public function applyQueryFilter(string $filter, Builder $query): Builder
    {
        if(!$filter)
            return $query;

        $columns = Schema::getColumnListing($query->from);

        foreach($columns as $key => $column)
            if($key == 0)
                $query->where($column, 'LIKE', "%$filter%");
            else
                $query->orWhere($column, 'LIKE', "%$filter%");
        
        return $query;
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }
}

