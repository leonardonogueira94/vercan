<?php

namespace App\Repositories;

use App\Services\ReceitaService;

class LegalPersonRepository
{
    public function __construct(
        private readonly ReceitaService $receitaService,
    ){}

    public function getLegalPersonByCnpj(string $cnpj)
    {
        
    }
}