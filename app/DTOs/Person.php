<?php

namespace App\DTOs;

class Person
{
    public ?string $personable_type;
    public ?int $personable_id;
    public ?bool $is_active;

    public function __construct(
        ?string $personable_type = null,
        ?int $personable_id = null,
        ?bool $is_active = null
    ) {
        $this->personable_type = $personable_type;
        $this->personable_id = $personable_id;
        $this->is_active = $is_active;
    }
}