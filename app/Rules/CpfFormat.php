<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cpf = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cpf) !== 11)
            $fail('CPF inválido.');

        if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value))
            $fail('CPF inválido.');
    }
}
