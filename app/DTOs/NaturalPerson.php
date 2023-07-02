<?php

namespace App\DTOs;

class NaturalPersonDTO
{
    public ?string $cpf;
    public ?string $name;
    public ?string $alias;
    public ?string $rg;

    public function __construct(
        ?string $cpf = null,
        ?string $name = null,
        ?string $alias = null,
        ?string $rg = null
    ) {
        $this->cpf = $cpf;
        $this->name = $name;
        $this->alias = $alias;
        $this->rg = $rg;
    }
}