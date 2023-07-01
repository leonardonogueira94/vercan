<?php

namespace App\Models;

use App\Concerns\HasContact;
use App\Enums\Person\PersonStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Person extends Model
{
    use HasFactory, HasContact;

    protected function getIsActiveAttribute($value): string
    {
        return PersonStatus::tryFrom($value)->label();
    }

    public function personable(): MorphTo
    {
        return $this->morphTo();
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
