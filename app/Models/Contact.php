<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    use HasFactory;

    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    public function person(): HasOne
    {
        return $this->hasOne(Person::class);
    }
}
