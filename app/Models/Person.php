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

    public function personable(): MorphTo
    {
        return $this->morphTo();
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
