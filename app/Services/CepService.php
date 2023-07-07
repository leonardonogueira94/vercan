<?php

namespace App\Services;

use App\Repositories\CityRepository;
use Illuminate\Support\Facades\Http;

class CepService
{
    public function __construct(
        public CityRepository $cityRepository,
    ){}

    private string $baseUrl = 'https://viacep.com.br/ws/';

    public function getAddressDataByCep(string|null $cep): object|false
    {
        $response = Http::get("$this->baseUrl/$cep/json");

        $data = (object) $response->json();

        if(!property_exists($data, $this->getAddressDataMap()['uf']))
            return false;

        if(!property_exists($data, $this->getAddressDataMap()['city']))
            return false;
        
        if(!$this->cityRepository->cityAlreadyRegistered($data->{$this->getAddressDataMap()['uf']}, $data->{$this->getAddressDataMap()['city']}))
            $this->cityRepository->createCity($data->{$this->getAddressDataMap()['uf']}, $data->{$this->getAddressDataMap()['city']});

        return $data;
    }

    public function getAddressDataMap(): array
    {
        return [
            'cep' => 'cep',
            'address' => 'logradouro',
            'buildingNumber' => 'numero',
            'complement' => 'complemento',
            'area' => 'bairro',
            'uf' => 'uf',
            'city' => 'localidade',
        ];
    }
}
