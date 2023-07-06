<?php

namespace Tests\Feature\Livewire\Person;

use App\Http\Livewire\Person\EditPerson;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Utils\HasProvider;

class EditPersonTest extends TestCase
{
    use HasProvider;

    /**
     * @test
     * @dataProvider cepProvider
     * @covers \App\Http\Livewire\EditPerson::updated
     * @covers \App\Http\Livewire\EditPerson::fillAddress
     * @covers \App\Services\CepService::getAddressDataByCep
     * @covers \App\Services\CepService::getAddressDataMap
     */
    public function test_if_address_gets_filled_when_cep_is_filled(string $cep, string $expectedCompanyName)
    {
        $person = Person::first();
        
        $component = Livewire::test(EditPerson::class, ['person' => $person])
        ->set('cep', $cep)
        ->assertNotSet('address', $person->address->address)
        ->assertSet('address', $expectedCompanyName);
    }

    /**
     * @test
     * @dataProvider cnpjProvider
     * @covers \App\Http\Livewire\EditPerson::updated
     * @covers \App\Services\ReceitaService::getLegalPersonData
     * @covers \App\Services\ReceitaService::getLegalPersonDataMap
     * @covers \App\Http\Livewire\EditPerson::fillPersonData
     */
    public function test_if_company_name_gets_filled_when_cnpj_is_filled(string $cnpj, string $expectedCompanyName)
    {
        $person = Person::first();
        
        $component = Livewire::test(EditPerson::class, ['person' => $person])
        ->set('cnpj', $cnpj)
        ->assertNotSet('companyName', $person->company_name)
        ->assertSet('companyName', $expectedCompanyName);
    }
}
