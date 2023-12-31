<?php

namespace App\Models;

use App\Concerns\HasContact;
use App\Enums\Person\PersonStatus;
use App\Enums\Person\StateRegistrationCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Person extends Model
{
    use HasFactory, HasContact;

    protected $guarded = [];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
