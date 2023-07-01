<?php

declare(strict_types=1);

namespace App\Enums\Contact;

use App\Concerns\Enumerable;
use App\Enums\Contact\ContactChannel;

enum ContactType: string
{
    use Enumerable;
    
    case RESIDENCIAL = 'residential';
    case COMERCIAL = 'commercial';
    case CELULAR = 'cellphone';
    case PESSOAL = 'personal';
    case OUTRO = 'other';

    public function canais(): array
    {
        return match($this){
            self::RESIDENCIAL, self::CELULAR => [ContactChannel::TELEFONE],
            self::PESSOAL, self::OUTRO => [ContactChannel::EMAIL],
            self::COMERCIAL => [ContactChannel::EMAIL, ContactChannel::TELEFONE],
        };
    }
}