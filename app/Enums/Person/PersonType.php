<?php

declare(strict_types=1);

namespace App\Enums\Person;

use App\Concerns\Enumerable;

enum PersonType: string
{
    use Enumerable;

    case FISICA = 'F';
    case JURIDICA = 'J';

    public function label(): string
    {
        return match($this){
            self::FISICA => 'Pessoa Física',
            self::JURIDICA => 'Pessoa Jurídica',
        };
    }
}