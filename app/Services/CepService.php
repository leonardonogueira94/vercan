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

    public function getAddressDataByCep(string $cep): object
    {
        $response = Http::get("$this->baseUrl/$cep/json");

        $data = (object) $response->json();

        if(!$this->cityRepository->cityAlreadyRegistered($data->{$this->getAddressDataMap()['uf']}, $data->{$this->getAddressDataMap()['uf']}))
            $this->cityRepository->createCity($data->{$this->getAddressDataMap()['uf']}, $data->{$this->getAddressDataMap()['uf']});

        return $data;
    }

    public function getAddressDataMap(): array
    {
        return [
            'cep' => 'cep',
            'address' => 'logradouro',
            'building_number' => 'numero',
            'complement' => 'complemento',
            'area' => 'bairro',
            'uf' => 'uf',
            'city' => 'localidade',
        ];
    }
}
