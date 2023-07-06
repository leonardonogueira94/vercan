<?php

use PHPUnit\Framework\TestCase;
use App\Services\MaskService;
use Tests\Utils\HasProvider;

class MaskServiceTest extends TestCase
{
    use HasProvider;
    
    /**
     * @dataProvider cnpjProvider
     * @covers \App\Services\MaskService::maskCnpj
     */
    public function test_if_cnpj_can_be_formatted($cnpj, $expectedCnpj)
    {
        $maskService = new MaskService();

        $maskedCnpj = $maskService->maskCnpj($cnpj);

        $this->assertEquals($expectedCnpj, $maskedCnpj);
    }

    /**
     * @dataProvider cpfProvider
     * @covers \App\Services\MaskService::maskCpf
     */
    public function test_if_cpf_can_be_formatted($cpf, $expectedCpf)
    {
        $maskService = new MaskService();

        $maskedCpf = $maskService->maskCpf($cpf);

        $this->assertEquals($expectedCpf, $maskedCpf);
    }
}