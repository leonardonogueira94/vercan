<?php

namespace App\Services;

use App\Repositories\AddressRepository;
use Illuminate\Support\Facades\Http;

class ReceitaService
{
    public function __construct(
        private AddressRepository $addressRepository
    ){}

    private string $baseUrl = 'https://receitaws.com.br/v1/cnpj';

    public function getLegalPersonData(string $cnpj): object
    {
        $response = Http::get("$this->baseUrl/$cnpj");

        $data = (object) $response->json();

        if(!$this->addressRepository->cityAlreadyRegistered($data->municipio))
            $this->addressRepository->createCity($data->uf, $data->municipio);

        return $data;
    }

    public function getLegalPersonDataMap(): array
    {
        return [
            'company_name' => 'nome',
            'trading_name' => 'fantasia',
            'cnpj_status' => 'situacao',
        ];
    }

    public function getAddressDataMap(): array
    {
        return [
            'cep' => 'cep',
            'address' => 'logradouro',
            'building_number' => 'numero',
            'complement' => 'complemento',
            'area' => 'bairro',
        ];
    }
}
