<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class LegalPerson extends Person
{
    use HasFactory;

    public function person(): MorphOne
    {
        return $this->morphOne(Person::class, 'personable');
    }
}
