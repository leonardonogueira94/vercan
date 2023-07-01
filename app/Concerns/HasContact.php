<?php

namespace App\Concerns;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait HasContact
{
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function emails(): HasManyThrough
    {
        return $this->hasManyThrough(Email::class, App\Concerns\Contact::class);
    }

    public function phones(): HasManyThrough
    {
        return $this->hasManyThrough(Phone::class, App\Concerns\Contact::class);
    }
}