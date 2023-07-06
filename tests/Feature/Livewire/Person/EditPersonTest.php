<?php

namespace Tests\Feature\Livewire\Person;

use App\Enums\Person\PersonType;
use App\Http\Livewire\Person\EditPerson;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Utils\HasProvider;

class EditPersonTest extends TestCase
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
        $people = Person::with('address.city')->limit(30)->get();

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

    public function if_address_gets_displayed()
    {
        
    }

    public function test_if_cnpj_input_gets_masked()
    {

    }

    public function test_if_cep_input_gets_masked()
    {
        
    }

    public function test_if_cellphone_input_gets_masked()
    {
        
    }

    public function test_if_phone_input_gets_masked()
    {
        
    }

    public function test_if_new_inputs_appears_when_contact_is_added()
    {
        
    }

    public function test_if_new_inputs_appears_when_phone_is_added()
    {
        
    }

    public function test_if_new_inputs_appears_when_email_is_added()
    {
        
    }

    public function test_if_inputs_disappears_when_contact_is_removed()
    {
        
    }

    public function test_if_inputs_disappears_when_phone_is_removed()
    {
        
    }

    public function test_if_inputs_disappears_when_email_is_removed()
    {
        
    }
}
