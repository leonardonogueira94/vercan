<?php

namespace App\Concerns;

trait Enumerable
{
    public static function toArray(): array
    {
        $keys = array_column(static::cases(), 'name');

        $values = array_column(static::cases(), 'value');

        return array_combine($keys, $values);
    }
}