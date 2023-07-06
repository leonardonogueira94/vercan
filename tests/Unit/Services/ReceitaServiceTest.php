<?php

use PHPUnit\Framework\TestCase;
use App\Services\ReceitaService;
use Tests\Utils\HasProvider;

class ReceitaServiceTest extends TestCase
{
    use HasProvider;

    /**
     * @test
     * @medium
     * @dataProvider cnpjProvider
     * @covers \App\Services\ReceitaService::getLegalPersonData
     */
    public function if_legal_person_data_can_be_obtained_from_cnpj(string $cnpj)
    {
        
    }
}