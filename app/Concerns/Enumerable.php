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

    public static function commaSeparated(): string
    {
        return implode(', ', array_column(static::cases(), 'value'));
    }
}