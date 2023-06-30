<?php

declare(strict_types=1);

namespace App\Enums\Person;

use App\Concerns\Enumerable;

enum StateRegistrationCategory: string
{
    use Enumerable;

    case CONTRIBUINTE = 'C';
    case NAO_CONTRIBUINTE = 'NC';
    case ISENTO = 'I';

    public function label(): string
    {
        return match($this){
            self::CONTRIBUINTE => 'Contribuinte',
            self::NAO_CONTRIBUINTE => 'Não Contribuinte',
            self::ISENTO => 'Contribuinte Isento',
        };
    }

    public static function labels(): array
    {
        return array_map(fn($case) => $case->label(), static::cases());
    }
}