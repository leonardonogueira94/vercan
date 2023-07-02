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

    public function required(): bool
    {
        return match($this){
            self::CONTRIBUINTE, self::NAO_CONTRIBUINTE => true,
            self::ISENTO => false,
        };
    }
}