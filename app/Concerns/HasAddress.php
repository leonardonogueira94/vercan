<?php

namespace App\Concerns;

use App\Models\Address;

trait HasAddress
{
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}