<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    use HasFactory;

    public function city(): HasOne
    {
        return $this->hasOne(City::class);
    }

    public function person(): HasOne
    {
        return $this->hasOne(Person::class);
    }
}
