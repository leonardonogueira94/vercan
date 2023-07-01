<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\City;
use App\Models\State;
use App\Services\CepService;

class AddressRepository
{
    public function __construct(
        private readonly CepService $cepService,
    ){}

    public function getAddressByCep(string $cep): Address
    {

    }

    public function createCity(string $state, string $city): City
    {

    }

    public function createState(string $state): State
    {

    }
}