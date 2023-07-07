<?php

namespace App\Http\Requests;

use App\Enums\Person\PersonStatus;
use App\Enums\Person\PersonType;
use App\Enums\Person\StateRegistrationCategory;
use App\Enums\Person\TaxCollectionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class EditPersonRequest extends FormRequest
{
    public function __construct(
        public ?PersonType $personType = null,
        public ?StateRegistrationCategory $stateRegistrationCategory = null,
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
            'type' => ['required', new Enum(PersonType::class)],
            'personStatus' => ['required', Rule::in('Sim', 'Não')],
            'referencePoint' => 'max:255',
            'contacts.*.contact_name' => 'max:255',
            'contacts.*.company_name' => 'max:255',
            'contacts.*.job_title' => 'max:255',
            'contacts.*.emails.*.type' => 'max:30',
            'contacts.*.emails.*.email' => 'max:100',
            'contacts.*.phones.*.type' => '',
            'contacts.*.phones.*.phone' => 'max:18',
            'contacts.0.phones.0.phone' => 'required|max:18',
            'cep' => 'required|max:10',
            'address' => 'required|max:255',
            'buildingNumber' => 'required|max:10',
            'complement' => 'max:255',
            'area' => 'required|max:255',
            'uf' => 'required|exists:cities,uf',
            'city' => 'required',
            'isCondo' => 'required|boolean',
            'observation' => 'max:500',
        ];

        if($this->personType == PersonType::JURIDICA)
            return array_merge($defaultRules, $this->rulesForLegalPerson());

        if($this->personType == PersonType::FISICA)
            return array_merge($defaultRules, $this->rulesForNaturalPerson());
    }

    public function rulesForLegalPerson(): array
    {
        return [
            'cnpj' => [Rule::requiredIf($this->personType == PersonType::JURIDICA), 'min:18'],
            'cnpjStatus' => 'max:20',
            'companyName' => [Rule::requiredIf($this->personType == PersonType::JURIDICA), 'max:255'],
            'tradingName' => [Rule::requiredIf($this->personType == PersonType::JURIDICA), 'min:255'],
            'stateRegistrationCategory' => ['required', Rule::in(StateRegistrationCategory::toArray())],
            'ie' => ['max:15', Rule::requiredIf($this->stateRegistrationCategory?->required() ?? false)],
            'im' => 'max:15',
            'taxCollectionType' => ['required', Rule::in(TaxCollectionType::toArray())],
        ];
    }

    public function rulesForNaturalPerson(): array
    {
        return [
            'cpf' => [Rule::requiredIf($this->personType == PersonType::FISICA), 'min:11', 'max:14'],
            'name' => [Rule::requiredIf($this->personType == PersonType::FISICA), 'min:3', 'max:255'],
            'alias' => 'max:255',
            'rg' => [Rule::requiredIf($this->personType == PersonType::FISICA), 'min:8', 'max:14'],
        ];
    }
}