<?php

namespace Tests\Feature\Livewire\Person;

use App\Http\Livewire\Person\CreatePerson;
use App\Models\City;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Utils\HasProvider;

class CreatePersonTest extends TestCase
{
    use HasProvider, RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * @test
     * @medium
     * @dataProvider cepProvider
     * @covers \App\Http\Livewire\CreatePerson::fillAddress
     * @covers \App\Services\CepService::getAddressDataByCep
     * @covers \App\Services\CepService::getAddressDataMap
     */
    public function if_address_gets_filled_when_cep_is_filled(string $cep, string $expectedCompanyName)
    {
        $person = Person::first();
        
        $component = Livewire::test(CreatePerson::class)
        ->set('cep', $cep)
        ->assertNotSet('address', $person->address->address)
        ->assertSet('address', $expectedCompanyName);
    }

    /**
     * @test
     * @medium
     * @dataProvider razaoProvider
     * @covers \App\Services\ReceitaService::getLegalPersonData
     * @covers \App\Services\ReceitaService::getLegalPersonDataMap
     * @covers \App\Http\Livewire\CreatePerson::fillPersonData
     */
    public function if_company_name_gets_filled_when_cnpj_is_filled(string $cnpj, string $expectedCompanyName)
    {
        $person = Person::first();
        
        $component = Livewire::test(CreatePerson::class)
        ->set('cnpj', $cnpj)
        ->assertNotSet('companyName', $person->company_name)
        ->assertSet('companyName', $expectedCompanyName);
    }

    /**
     * @test
     * @small
     */
    public function if_city_dropdown_shows_cities_from_chosen_uf()
    {
        $ufs = City::groupBy('uf')->get();

        $component = Livewire::test(CreatePerson::class);

        foreach($ufs as $uf)
        {
            $uf = $uf->uf;

            $cities = City::where('uf', $uf)->get();

            $component->assertSeeHtml($uf)
            ->set('uf', $uf)
            ->assertSeeHtml($uf);

            foreach($cities as $city)
            {
                $component
                ->assertSeeHtml(e($city->name))
                ->assertSeeHtml(e($city->uf));
            }
        }
    }

    public function if_cannot_register_person_until_at_least_one_phone_is_filled()
    {

    }
}
