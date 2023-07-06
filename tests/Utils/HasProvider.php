<?php

namespace Tests\Utils;

use App\Models\Person;

trait HasProvider
{
    public function cepProvider(): array
    {
        return [
            ['cep' => '13030-600', 'expectedAddress' => 'Rua Benigno Ribeiro'],
        ];
    }

    public function razaoProvider(): array
    {
        return [
            ['cnpj' => '07019231000196', 'expectedCompanyName' => 'KENERSON INDUSTRIA E COMERCIO DE PRODUTOS OPTICOS LTDA'],
        ];
    }

    public function cpfProvider()
    {
        return [
            ['12345678900', '123.456.789-00'],
            ['11122233344', '111.222.333-44'],
            ['99988877766', '999.888.777-66'],
        ];
    }

    public function cnpjProvider()
    {
        return [
            ['12345678000190', '12.345.678/0001-90'],
            ['11111111000199', '11.111.111/0001-99'],
            ['99999999000155', '99.999.999/0001-55'],
        ];
    }
}