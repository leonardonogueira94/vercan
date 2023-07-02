<?php

namespace App\Models;

use App\Concerns\HasContact;
use App\Enums\Person\PersonStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Person extends Model
{
    use HasFactory, HasContact;

    public function getIsActiveAttribute($value): string
    {
        if(in_array($value, ['Não', 'Sim']))
            return array_search($value, ['Não', 'Sim']);

        return PersonStatus::tryFrom($value)->label();
    }

    public function personable(): MorphTo
    {
        return $this->morphTo();
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
