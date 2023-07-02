<?php

namespace App\DTOs;

class Address
{
    public ?int $city_id;
    public ?int $person_id;
    public ?string $cep;
    public ?string $address;
    public ?string $building_number;
    public ?string $complement;
    public ?string $area;
    public ?string $reference_point;
    public ?bool $is_condo;

    public function __construct(
        ?int $city_id = null,
        ?int $person_id = null,
        ?string $cep = null,
        ?string $address = null,
        ?string $building_number = null,
        ?string $complement = null,
        ?string $area = null,
        ?string $reference_point = null,
        ?bool $is_condo = null
    ) {
        $this->city_id = $city_id;
        $this->person_id = $person_id;
        $this->cep = $cep;
        $this->address = $address;
        $this->building_number = $building_number;
        $this->complement = $complement;
        $this->area = $area;
        $this->reference_point = $reference_point;
        $this->is_condo = $is_condo;
    }
}