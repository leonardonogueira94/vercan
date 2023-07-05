<?php

namespace Database\Factories;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    public array $capitals = [
        "AC" => "Rio Branco",
        "AL" => "Maceió",
        "AM" => "Manaus",
        "AP" => "Macapá",
        "BA" => "Salvador",
        "CE" => "Fortaleza",
        "DF" => "Brasília",
        "ES" => "Vitória",
        "GO" => "Goiânia",
        "MA" => "São Luís",
        "MG" => "Belo Horizonte",
        "MS" => "Campo Grande",
        "MT" => "Cuiabá",
        "PA" => "Belém",
        "PB" => "João Pessoa",
        "PE" => "Recife",
        "PI" => "Teresina",
        "PR" => "Curitiba",
        "RJ" => "Rio de Janeiro",
        "RN" => "Natal",
        "RO" => "Porto Velho",
        "RR" => "Boa Vista",
        "RS" => "Porto Alegre",
        "SC" => "Florianópolis",
        "SE" => "Aracaju",
        "SP" => "São Paulo",
        "TO" => "Palmas"
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $capital = fake()->unique()->randomElement($this->capitals);

        return [
            'uf' =>  array_search($capital, $this->capitals),
            'name' => $capital,
        ];
    }
}
