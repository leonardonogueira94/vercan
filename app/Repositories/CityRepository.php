<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository
{
    public function createCity(string $uf, string $city): City
    {
        $city = City::create([
            'uf' => $uf,
            'name' => $city,
        ]);

        return $city;
    }

    public function cityAlreadyRegistered(string $uf, string $name): bool
    {
        return City::where(['uf' => $uf], ['name' => $name])->exists();
    }
}