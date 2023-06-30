<?php

declare(strict_types=1);

namespace App\Enums\Contact;

use App\Concerns\Enumeravel;
use App\Enums\Contact\ContactType;

enum ContactChannel: string
{
    use Enumeravel;
    
    case TELEFONE = 'phone';
    case EMAIL = 'email';

    public function tipos(): array
    {
        return match($this){
            self::TELEFONE => [ContactType::RESIDENCIAL, ContactType::COMERCIAL, ContactType::CELULAR],
            self::EMAIL => [ContactType::PESSOAL, ContactType::COMERCIAL, ContactType::OUTRO],
        };
    }
}