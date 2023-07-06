<?php

namespace Tests\Feature\Livewire\Person;

use App\Http\Livewire\Person\EditPerson;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreatePersonTest extends TestCase
{
    public $component;

    /**
     * @test
     * @dataProvider personProvider
     */
    public function test_if_(string $cnpj, string $expectedCompanyName)
    {
        $person = Person::first();
        
        $component = Livewire::test(EditPerson::class, ['person' => $person])
        ->set('cnpj', $cnpj)
        ->assertNotSet('companyName', $person->company_name)
        ->assertSet('companyName', $expectedCompanyName);
        
        return $component;
    }

    public function personProvider(): array
    {
        return [
            ['cnpj' => '07019231000196', 'expectedCompanyName' => 'KENERSON INDUSTRIA E COMERCIO DE PRODUTOS OPTICOS LTDA'],
        ];
    }
}
