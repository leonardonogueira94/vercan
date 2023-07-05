<?php

namespace App\Concerns\Livewire;

use App\Services\CepService;
use App\Services\MaskService;
use App\Services\ReceitaService;

trait FillsPersonField
{
    private ReceitaService $receitaService;

    private CepService $cepService;

    private MaskService $maskService;

    public function fillPersonData($addressData): bool
    {
        if(!$addressData)
            return false;

        foreach($this->receitaService->getLegalPersonDataMap() as $column => $field)
            $this->$column = $addressData->$field;

        foreach($this->receitaService->getAddressDataMap() as $column => $field)
            $this->$column = $addressData->$field;

            return true;
    }

    public function fillAddress($addressData): bool
    {        
        if(!$addressData)
            return false;

        foreach($this->cepService->getAddressDataMap() as $column => $field)
            if(property_exists($addressData, $field) && !in_array($column, ['uf', 'city', 'cep']))
                $this->$column = $addressData->$field;
        
        $this->cep = $addressData->{$this->cepService->getAddressDataMap()['cep']};
        $this->uf = $addressData->{$this->cepService->getAddressDataMap()['uf']};
        $this->city->name = $addressData->{$this->cepService->getAddressDataMap()['city']};

        return true;
    }
}