<?php

namespace App\DTOs;

class Email
{
    public ?int $contact_id;
    public ?string $email;
    public ?string $type;

    public function __construct(
        ?int $contact_id = null,
        ?string $email = null,
        ?string $type = null
    ) {
        $this->contact_id = $contact_id;
        $this->email = $email;
        $this->type = $type;
    }
}