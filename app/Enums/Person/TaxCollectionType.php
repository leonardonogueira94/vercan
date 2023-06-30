<?php

declare(strict_types=1);

namespace App\Enums\Person;

use App\Concerns\Enumerable;

enum TaxCollectionType: string
{
    use Enumerable;

    case RECOLHER_PRESTADOR = 'RP';
    case RETIDO_TOMADOR = 'RT';

    public function label(): string
    {
        return match($this){
            self::RECOLHER_PRESTADOR => 'A Recolher pelo Prestador',
            self::RETIDO_TOMADOR => 'Retido Pelo Tomador',
        };
    }

    public static function labels(): array
    {
        return array_map(fn($case) => $case->label(), static::cases());
    }
}