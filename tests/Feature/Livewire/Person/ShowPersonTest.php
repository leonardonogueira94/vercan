<?php

namespace Tests\Feature\Livewire\Person;

use App\Enums\Person\PersonType;
use App\Http\Livewire\Person\ShowPerson;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Utils\HasProvider;

class ShowPersonTest extends TestCase
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
     * @covers \App\Http\Livewire\ShowPerson::retrieveContacts
     */
    public function test_if_contacts_can_be_retrivied()
    {
        $people = Person::limit(20)->get();

        foreach($people as $person)
        {
            $component = Livewire::test(ShowPerson::class, ['person' => $person]);
            
            foreach($person->contacts as $contact)
            {
                if(!$contact->is_default)
                    $component->assertSee($contact->contact_name)
                    ->assertSee($contact->company_name)
                    ->assertSee($contact->job_title);

                foreach($contact->phones as $phone)
                    $component->assertSeeHtml($phone->phone)
                    ->assertSeeHtml($phone->type);

                foreach($contact->emails as $email)
                    $component->assertSeeHtml($email->email)
                    ->assertSeeHtml($email->type);
            }
        }
    }

    /**
     * @test
     * @medium
     * @covers \App\Http\Livewire\ShowPerson::mount
     */
    public function if_form_gets_filled_with_person_data()
    {
        $people = Person::limit(30)->get();

        foreach($people as $person)
        {            
            $component = Livewire::test(ShowPerson::class, ['person' => $person])->assertSet('type', $person->type)
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
     * @covers \App\Http\Livewire\ShowPerson::mount
     */
    public function if_address_gets_displayed()
    {
        $people = Person::with('address.city')->limit(30)->get();

        foreach($people as $person)
        {            
            $component = Livewire::test(ShowPerson::class, ['person' => $person])
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
}
