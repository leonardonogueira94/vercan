<?php

namespace App\Services;

class MaskService
{
    public function maskCnpj(string $cnpj = null): string|null
    {
        if(!$cnpj)
            return null;

        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        $maskedCnpj = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);

        return $maskedCnpj;
    }

    public function maskCpf(string $cpf = null): string|null
    {
        if(!$cpf)
            return null;

        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        $maskedCpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);

        return $maskedCpf;
    }

    function maskCep(string $cep = null): string|null
    {
        if(!$cep)
            return null;

        $cep = preg_replace('/[^0-9]/', '', $cep);
    
        if (strlen($cep) != 8)
            return null;
    
        $maskedCep = substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    
        return $maskedCep;
    }

    public function unmask(string $data = null): string|null
    {
        if(!$data)
            return null;

        return preg_replace('/[^0-9]/', '', $data);
    }

    function maskCellphone($cellNumber): string|null
    {
        if(!$cellNumber)
            return null;

        $cellNumber = preg_replace('/\D/', '', $cellNumber);

        if (strlen($cellNumber) !== 11)
            return null;

        return '(' . substr($cellNumber, 0, 2) . ') ' . substr($cellNumber, 2, 5) . '-' . substr($cellNumber, 7);
    }
}
