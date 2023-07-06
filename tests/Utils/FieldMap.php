<?php

namespace Tests\Utils;

class FieldMap
{
    const LEGAL_PERSON_FIELDS = [
        'companyName' => 'company_name',
        'tradingName' => 'trading_name',
        'stateRegistrationCategory' => 'ie_category',
        'ie' => 'ie',
        'im' => 'im',
        'cnpjStatus' => 'cnpj_status',
        'taxCollectionType' => 'tax_type',
    ];

    const NATURAL_PERSON_FIELDS = [
        'name' => 'name',
        'alias' => 'alias',
        'cpf' => 'cpf',
        'rg' => 'rg',
    ];

    const PERSON_COMMON_FIELDS = [
        'personStatus' => 'is_active',
        'observation' => 'observation',
    ];

    const ADDRESS_FIELDS = [
        'uf' => 'uf',
        'city' => 'name',
        'cep' => 'cep',
        'address' => 'address',
        'buildingNumber' => 'building_number',
        'complement' => 'complement',
        'area' => 'area',
        'referencePoint' => 'reference_point',
        'isCondo' => 'is_condo',
    ];
}