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
        $state = State::where('acronym', $state)->firstOrFail();

        $city = City::create([
            'state_id' => $state->id,
            'name' => $city,
        ]);

        return $city;
    }

    public function cityAlreadyRegistered(string $name): bool
    {
        return City::where('name', $name)->exists();
    }
}