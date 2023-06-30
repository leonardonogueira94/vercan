<?php

declare(strict_types=1);

namespace App\Enums\Person;

enum PersonStatus: int
{
    case ATIVA = 1;
    case INATIVA = 0;

    public function label()
    {
        return match($this){
            PersonStatus::ATIVA => 'Sim',
            PersonStatus::INATIVA => 'Não',
        };
    }
}