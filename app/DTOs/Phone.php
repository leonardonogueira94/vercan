<?php

namespace App\DTOs;

class Phone
{
    public ?int $contact_id;
    public ?string $phone;
    public ?string $type;

    public function __construct(
        ?int $contact_id = null,
        ?string $phone = null,
        ?string $type = null
    ) {
        $this->contact_id = $contact_id;
        $this->phone = $phone;
        $this->type = $type;
    }
}