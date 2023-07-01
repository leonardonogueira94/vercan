<?php

namespace App\Models;

use App\Enums\Person\PersonStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Person extends Model
{
    use HasFactory;

    protected function getIsActiveAttribute($value): string
    {
        return PersonStatus::tryFrom($value)->label();
    }

    public function personable(): MorphTo
    {
        return $this->morphTo();
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function addresses(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
