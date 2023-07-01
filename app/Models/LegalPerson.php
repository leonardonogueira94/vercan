<?php

namespace App\Models;

use App\Enums\Person\StateRegistrationCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class LegalPerson extends Person
{
    use HasFactory;

    public function person(): MorphOne
    {
        return $this->morphOne(Person::class, 'personable');
    }

    public function getIeCategoryAttribute($value)
    {
        if(!$value)
            return null;

        return StateRegistrationCategory::tryFrom($value);
    }

    /* public function getCnpjAttribute($value)
    {        
        if (!$value)
            return null;

        $cnpj = preg_replace('/\D/', '', $value);
        
        return substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
    } */
}
