<?php

declare(strict_types=1);

namespace App\Enums\Person;

use App\Concerns\Enumerable;

enum PersonStatus: int
{
    use Enumerable;
    
    case INATIVA = 0;
    case ATIVA = 1;

    public function label()
    {
        return match($this){
            PersonStatus::INATIVA => 'Não',
            PersonStatus::ATIVA => 'Sim',
        };
    }
}