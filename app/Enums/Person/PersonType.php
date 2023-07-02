<?php

declare(strict_types=1);

namespace App\Enums\Person;

use App\Concerns\Enumerable;
use App\Models\LegalPerson;
use App\Models\NaturalPerson;

enum PersonType: string
{
    use Enumerable;

    case FISICA = 'F';
    case JURIDICA = 'J';

    public function class(): string
    {
        return match($this){
            self::FISICA => NaturalPerson::class,
            self::JURIDICA => LegalPerson::class,
        };
    }

    public function label(): string
    {
        return match($this){
            self::FISICA => 'Pessoa Física',
            self::JURIDICA => 'Pessoa Jurídica',
        };
    }
}