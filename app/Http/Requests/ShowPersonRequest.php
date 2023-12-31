<?php

namespace App\Http\Requests;

use App\Enums\Person\PersonType;
use App\Enums\Person\StateRegistrationCategory;
use App\Enums\Person\TaxCollectionType;
use App\Models\Person;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ShowPersonRequest extends FormRequest
{
    public function __construct(
        private Person $person,
    ){}

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $defaultRules = [
            'person.type' => ['required', new Enum(PersonType::class)],
            'person.is_active' => ['required', Rule::in('Sim', 'Não')],
            'person.address.reference_point' => 'max:255',
            'person.contacts.*.contact_name' => 'max:255',
            'person.contacts.*.company_name' => 'max:255',
            'person.contacts.*.job_title' => 'max:255',
            'person.contacts.*.emails.*.type' => 'max:30',
            'person.contacts.*.emails.*.email' => 'max:100',
            'person.contacts.*.phones.*.type' => '',
            'person.contacts.*.phones.*.phone' => 'max:18',
            'person.address.cep' => 'required|max:10',
            'person.address.address' => 'required|max:255',
            'person.address.building_number' => 'required|max:10',
            'person.address.complement' => 'max:255',
            'person.address.area' => 'required|max:255',
            'person.address.city.uf' => 'required|exists:cities,uf',
            'person.address.city.name' => 'required',
            'person.address.is_condo' => 'required|boolean',
            'person.observation' => 'max:500',
        ];

        if($this->person->type == PersonType::JURIDICA->value)
            return array_merge($defaultRules, $this->rulesForLegalPerson());

        if($this->person->type == PersonType::FISICA->value)
            return array_merge($defaultRules, $this->rulesForNaturalPerson());
    }

    public function rulesForLegalPerson(): array
    {
        return [
            'person.cnpj' => 'required',
            'person.cnpj_status' => 'max:20',
            'person.company_name' => 'required|max:255',
            'person.trading_name' => 'required|max:255',
            'person.ie_category' => ['required', Rule::in(StateRegistrationCategory::toArray())],
            'person.ie' => ['max:15', Rule::requiredIf($this->stateRegistrationCategory?->required() ?? false)],
            'person.im' => 'max:15',
            'person.tax_type' => ['required', Rule::in(TaxCollectionType::toArray())],
        ];
    }

    public function rulesForNaturalPerson(): array
    {
        return [
            'person.cpf' => 'required',
            'person.name' => 'required|max:255',
            'person.alias' => 'max:255',
            'person.rg' => 'required',
        ];
    }
}