<?php

namespace App\DTOs;

class LegalPerson
{
    public ?string $cnpj;
    public ?string $company_name;
    public ?string $trading_name;
    public ?string $ie_category;
    public ?string $ie;
    public ?string $im;
    public ?string $cnpj_status;
    public ?string $tax_type;

    public function __construct(
        ?string $cnpj = null,
        ?string $company_name = null,
        ?string $trading_name = null,
        ?string $ie_category = null,
        ?string $ie = null,
        ?string $im = null,
        ?string $cnpj_status = null,
        ?string $tax_type = null
    ) {
        $this->cnpj = $cnpj;
        $this->company_name = $company_name;
        $this->trading_name = $trading_name;
        $this->ie_category = $ie_category;
        $this->ie = $ie;
        $this->im = $im;
        $this->cnpj_status = $cnpj_status;
        $this->tax_type = $tax_type;
    }
}