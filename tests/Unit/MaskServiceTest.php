<?php

use PHPUnit\Framework\TestCase;
use App\Services\MaskService;

class MaskServiceTest extends TestCase
{
    /**
     * @dataProvider cnpjProvider
     * @covers \App\Services\MaskService::formatarCNPJ
     */
    public function testFormatarCNPJ($cnpj, $expectedCnpj)
    {
        $maskService = new MaskService();

        $maskedCnpj = $maskService->maskCnpj($cnpj);

        $this->assertEquals($expectedCnpj, $maskedCnpj);
    }

    /**
     * @dataProvider cpfProvider
     * @covers \App\Services\MaskService::formatarCPF
     */
    public function testFormatarCPF($cpf, $expectedCpf)
    {
        $maskService = new MaskService();

        $maskedCpf = $maskService->maskCpf($cpf);

        $this->assertEquals($expectedCpf, $maskedCpf);
    }

    public function cnpjProvider()
    {
        return [
            ['12345678000190', '12.345.678/0001-90'],
            ['11111111000199', '11.111.111/0001-99'],
            ['99999999000155', '99.999.999/0001-55'],
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
}