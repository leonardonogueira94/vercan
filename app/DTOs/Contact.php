<?php

namespace App\DTOs;

use Illuminate\Support\Collection;

class Contact
{
    public ?int $person_id;
    public ?string $contact_name;
    public ?string $company_name;
    public ?string $job_title;
    public ?bool $is_default;
    public ?Collection $phones;
    public ?Collection $emails;

    public function __construct(
        ?int $person_id = null,
        ?string $contact_name = null,
        ?string $company_name = null,
        ?string $job_title = null,
        ?bool $is_default = null,
        ?Collection $phones = null,
        ?Collection $emails = null,
    ) {
        $this->person_id = $person_id;
        $this->contact_name = $contact_name;
        $this->company_name = $company_name;
        $this->job_title = $job_title;
        $this->is_default = $is_default;
        $this->phones = $phones;
        $this->emails = $emails;
    }
}