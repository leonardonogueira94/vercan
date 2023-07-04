<?php

namespace App\Http\Requests;

use App\Enums\Person\PersonType;
use App\Models\Person;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreatePersonRequest extends FormRequest
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
        return [
            'person.type' => ['required', new Enum(PersonType::class)],
            'person.is_active' => ['required', new Enum(PersonStatus::class)],
            'person.cnpj' => 'required|digits:14',
            'person.cnpj_status' => 'max:20',
            'person.company_name' => 'required|max:255',
            'person.trading_name' => 'required|max:255',
            'person.ie_category' => ['required', new Enum(StateRegistrationCategory::class)],
            'person.ie' => [Rule::requiredIf($this->person->ie_category?->required()), 'max:15'],
            'person.im' => 'max:15',
            'person.tax_type' => ['required', new Enum(TaxCollectionType::class)],
            'person.cpf' => 'required|max:11',
            'person.name' => 'required|max:255',
            'person.alias' => 'max:255',
            'person.rg' => 'rquired|max:9',
            'person.address.reference_point' => 'max:255',
            'person.contacts.*.contact_name' => 'max:5',
            'person.contacts.*.company_name' => 'max:5',
            'person.contacts.*.job_title' => 'max:5',
            'person.contacts.*.emails.*.type' => [new Enum(ContactType::class)],
            'person.contacts.*.emails.*.email' => 'email',
            'person.contacts.*.phones.*.type' => [new Enum(ContactType::class)],
            'person.contacts.*.phones.*.phone' => 'digits:13',
            'person.address.cep' => 'required|digits:8',
            'person.address.address' => 'required|max:255',
            'person.address.building_number' => 'required|digits:10',
            'person.address.street' => 'required|max:255',
            'person.address.number' => 'required|max:15',
            'person.address.complement' => 'max:255',
            'person.address.area' => 'required|max:255',
            'person.address.city.uf' => 'required|exists:cities,uf',
            'person.address.city.name' => 'required|exists:cities,name',
            'person.address.is_condo' => 'required|boolean',
        ];
    }
}
