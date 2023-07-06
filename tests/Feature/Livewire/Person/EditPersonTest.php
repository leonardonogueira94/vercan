<?php

namespace Tests\Feature\Livewire\Person;

use App\Enums\Person\PersonType;
use App\Http\Livewire\Person\EditPerson;
use App\Models\Person;
use App\Services\MaskService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Utils\HasProvider;

class EditPersonTest extends TestCase
{
    use HasProvider, RefreshDatabase;

    private MaskService $maskService;

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
     * @covers \App\Http\Livewire\EditPerson::updated
     * @covers \App\Http\Livewire\EditPerson::fillAddress
     * @covers \App\Services\CepService::getAddressDataByCep
     * @covers \App\Services\CepService::getAddressDataMap
     */
    public function if_address_gets_filled_when_cep_is_filled(string $cep, string $expectedCompanyName)
    {
        $person = Person::first();
        
        $component = Livewire::test(EditPerson::class, ['person' => $person])
        ->set('cep', $cep)
        ->assertNotSet('address', $person->address->address)
        ->assertSet('address', $expectedCompanyName);
    }

    /**
     * @test
     * @medium
     * @dataProvider cnpjProvider
     * @covers \App\Http\Livewire\EditPerson::updated
     * @covers \App\Services\ReceitaService::getLegalPersonData
     * @covers \App\Services\ReceitaService::getLegalPersonDataMap
     * @covers \App\Http\Livewire\EditPerson::fillPersonData
     */
    public function if_company_name_gets_filled_when_cnpj_is_filled(string $cnpj, string $expectedCompanyName)
    {
        $person = Person::first();
        
        $component = Livewire::test(EditPerson::class, ['person' => $person])
        ->set('cnpj', $cnpj)
        ->assertNotSet('companyName', $person->company_name)
        ->assertSet('companyName', $expectedCompanyName);
    }

    /**
     * @test
     * @medium
     * @covers \App\Http\Livewire\EditPerson::mount
     */
    public function if_form_gets_filled_with_person_data()
    {
        $people = Person::limit(30)->get();

        foreach($people as $person)
        {            
            $component = Livewire::test(EditPerson::class, ['person' => $person])->assertSet('type', $person->type)
            ->assertSet('person', $person);

            if($person->type == PersonType::JURIDICA->value)
            {
                $component->assertSee($person->company_name)
                ->assertSee($person->trading_name)
                ->assertSee($person->ie_category)
                ->assertSee($person->ie)
                ->assertSee($person->im)
                ->assertSee($person->cnpj_status)
                ->assertSee($person->tax_type)
                ->assertSee($person->is_active)
                ->assertSee($person->observation);
            }

            if($person->type == PersonType::FISICA->value)
            {
                $component->assertSee($person->name)
                ->assertSee($person->alias)
                ->assertSee($person->cpf)
                ->assertSee($person->name)
                ->assertSee($person->alias)
                ->assertSee($person->rg);
            }
        }
    }

    /**
     * @test
     * @medium
     * @covers \App\Http\Livewire\EditPerson::mount
     */
    public function if_address_gets_displayed()
    {
        $people = Person::with('address.city')->limit(30)->get();

        foreach($people as $person)
        {            
            $component = Livewire::test(EditPerson::class, ['person' => $person])
            ->assertSee($person->address->city->uf)
            ->assertSee($person->address->city->name)
            ->assertSee($person->cep)
            ->assertSee($person->address->address)
            ->assertSee($person->address->building_number)
            ->assertSee($person->address->complement)
            ->assertSee($person->address->area)
            ->assertSee($person->address->reference_point)
            ->assertSee($person->address->is_condo);
        }
    }

    public function if_it_is_able_to_update_person_data()
    {
        $people = Person::orderByAsc(10)->get();

        $otherPeople = Person::with('contacts.phones')
        ->with('contacts.emails')
        ->with('address.city')
        ->orderByDesc(10)
        ->get();

        foreach($people as $i => $person)
        {
            $component = Livewire::test(EditPerson::class, ['person' => $person]);

            if($person->type == PersonType::JURIDICA->value)
            {
                $component
                ->set('companyName', $person->company_name)
                ->set('tradingName', $person->trading_name)
                ->set('StateRegistrationCategory', $person->ie_category)
                ->set('ie', $person->ie)
                ->set('im', $person->im)
                ->set('cnpjStatus', $person->cnpj_status)
                ->set('taxCollectionType', $person->tax_type)
                ->set('personStatus', $person->is_active)
                ->set('observation', $person->observation);
            }

            if($person->type == PersonType::FISICA->value)
            {
                $component
                ->assertSee('name', $person->name)
                ->assertSee('alias', $person->alias)
                ->assertSee('cpf', $person->cpf)
                ->assertSee('name', $person->name)
                ->assertSee('alias', $person->alias)
                ->assertSee('rg', $person->rg);
            }
        }
    }
}
