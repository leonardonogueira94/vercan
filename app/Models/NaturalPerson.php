<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class NaturalPerson extends Person
{
    use HasFactory;

    public function person(): MorphOne
    {
        return $this->morphOne(Person::class, 'personable');
    }

    public function getCpfAttribute($value)
    {
        if (!$value)
            return null;

        $cpf = preg_replace('/\D/', '', $value);
        
        return $cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }
}
