<?php

namespace App\Concerns;

use App\Models\Contact;
use App\Models\ContactGroup;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait HasContact
{
    public function contactGroups(): HasMany
    {
        return $this->hasMany(ContactGroup::class);
    }

    public function contacts(): HasManyThrough
    {
        return $this->hasManyThrough(Contact::class, App\Concerns\ContactGroup::class);
    }
}