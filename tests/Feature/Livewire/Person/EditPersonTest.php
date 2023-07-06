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
use Tests\Utils\FieldMap;
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
            ->assertSee($person->address->cep)
            ->assertSee($person->address->address)
            ->assertSee($person->address->building_number)
            ->assertSee($person->address->complement)
            ->assertSee($person->address->area)
            ->assertSee($person->address->reference_point)
            ->assertSee($person->address->is_condo);
        }
    }

    /**
     * @test
     * @large
     */
    public function if_it_is_able_to_update_person_data()
    {
        $people = Person::orderBy(1)->get();

        $otherPeople = Person::with('contacts.phones')
        ->with('contacts.emails')
        ->with('address.city')
        ->orderByDesc(1)
        ->get();

        foreach($people as $i => $person)
        {
            $component = Livewire::test(EditPerson::class, ['person' => $person]);

            if($person->type == PersonType::JURIDICA->value)
                foreach(FieldMap::LEGAL_PERSON_FIELDS as $property => $column)
                $component
                ->set('companyName', $otherPeople->get($i)->company_name)
                ->set('tradingName', $otherPeople->get($i)->trading_name)
                ->set('stateRegistrationCategory', $otherPeople->get($i)->ie_category)
                ->set('ie', $otherPeople->get($i)->ie)
                ->set('im', $otherPeople->get($i)->im)
                ->set('cnpjStatus', $otherPeople->get($i)->cnpj_status)
                ->set('taxCollectionType', $otherPeople->get($i)->tax_type);

            if($person->type == PersonType::FISICA->value)
                $component
                ->set('name', $otherPeople->get($i)->name)
                ->set('alias', $otherPeople->get($i)->alias)
                ->set('cpf', $otherPeople->get($i)->cpf)
                ->set('name', $otherPeople->get($i)->name)
                ->set('alias', $otherPeople->get($i)->alias)
                ->set('rg', $otherPeople->get($i)->rg);

            $component
            ->set('personStatus', $otherPeople->get($i)->is_active)
            ->set('observation', $otherPeople->get($i)->observation)
            ->set('uf', $otherPeople->get($i)->address->city->uf)
            ->set('city', $otherPeople->get($i)->address->city->name)
            ->set('cep', $otherPeople->get($i)->address->cep)
            ->set('address', $otherPeople->get($i)->address->address)
            ->set('buildingNumber', $otherPeople->get($i)->address->building_number)
            ->set('complement', $otherPeople->get($i)->address->complement)
            ->set('area', $otherPeople->get($i)->address->area)
            ->set('referencePoint', $otherPeople->get($i)->address->reference_point)
            ->set('isCondo', $otherPeople->get($i)->address->is_condo);
            
            $component->call('submit');

            $legalPersonData = [
                'company_name' => $otherPeople->get($i)->company_name,
                'trading_name' => $otherPeople->get($i)->trading_name,
                'ie_category' => $otherPeople->get($i)->ie_category,
                'ie' => $otherPeople->get($i)->ie,
                'im' => $otherPeople->get($i)->im,
                'cnpj_status' => $otherPeople->get($i)->cnpj_status,
                'tax_type' => $otherPeople->get($i)->tax_type,
            ];

            $naturalPersonData = [
                'name' => $otherPeople->get($i)->name,
                'alias' => $otherPeople->get($i)->alias,
                'cpf' => $otherPeople->get($i)->cpf,
                'rg' => $otherPeople->get($i)->rg,
            ];

            $commonData = [
                'id' => $person->id,
                'is_active' => $otherPeople->get($i)->is_active,
                'observation' => $otherPeople->get($i)->observation,
            ];

            if($person->type == PersonType::JURIDICA->value)
                $this->assertDatabaseHas('people', $legalPersonData + $commonData);

            if($person->type == PersonType::FISICA->value)
                $this->assertDatabaseHas('people', $naturalPersonData + $commonData);

            if($person->type == PersonType::JURIDICA->value)
                $component
                ->assertSeeHtml($otherPeople->get($i)->company_name)
                ->assertSeeHtml($otherPeople->get($i)->trading_name)
                ->assertSeeHtml($otherPeople->get($i)->ie_category)
                ->assertSeeHtml($otherPeople->get($i)->ie)
                ->assertSeeHtml($otherPeople->get($i)->im)
                ->assertSeeHtml($otherPeople->get($i)->cnpj_status)
                ->assertSeeHtml($otherPeople->get($i)->tax_type);

            if($person->type == PersonType::FISICA->value)
                $component
                ->assertSeeHtml($otherPeople->get($i)->name)
                ->assertSeeHtml($otherPeople->get($i)->alias)
                ->assertSeeHtml($otherPeople->get($i)->cpf)
                ->assertSeeHtml($otherPeople->get($i)->name)
                ->assertSeeHtml($otherPeople->get($i)->alias)
                ->assertSeeHtml($otherPeople->get($i)->rg);

            $component->assertSeeHtml($otherPeople->get($i)->is_active)
            ->assertSeeHtml($otherPeople->get($i)->observation);
        }
    }
}
