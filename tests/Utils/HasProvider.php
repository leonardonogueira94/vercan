<?php

namespace Tests\Utils;

trait HasProvider
{
    public function cepProvider(): array
    {
        return [
            ['cep' => '13030-600', 'expectedAddress' => 'Rua Benigno Ribeiro'],
        ];
    }

    public function cnpjProvider(): array
    {
        return [
            ['cnpj' => '07019231000196', 'expectedCompanyName' => 'KENERSON INDUSTRIA E COMERCIO DE PRODUTOS OPTICOS LTDA'],
        ];
    }

    public function personProvider(): array
    {
        return [];
    }
}