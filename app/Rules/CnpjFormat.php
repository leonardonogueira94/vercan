<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CnpjFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cnpj = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cnpj) != 14)
            $fail('CNPJ inválido.');

        if (!preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $value))
            $fail('CNPJ inválido.');
    }
}
