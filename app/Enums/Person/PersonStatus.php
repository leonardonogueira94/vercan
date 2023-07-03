<?php

declare(strict_types=1);

namespace App\Enums\Person;

use App\Concerns\Enumerable;

enum PersonStatus: string
{
    use Enumerable;
    
    case INATIVA = 'Não';
    case ATIVA = 'Sim';

    public function label()
    {
        return match($this){
            PersonStatus::INATIVA => 'Não',
            PersonStatus::ATIVA => 'Sim',
        };
    }
}