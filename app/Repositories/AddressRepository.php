<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\City;
use App\Models\State;
use App\Services\CepService;

class AddressRepository
{
    public function __construct(
        public CepService $cepService,
    ){}

    /* public function getAddressByCep(string $cep): Address
    {
        return new Address();
    } */
}