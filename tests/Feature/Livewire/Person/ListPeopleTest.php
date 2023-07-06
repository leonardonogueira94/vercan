<?php

namespace Tests\Feature\Livewire\Person;

use App\Http\Livewire\Person\ListPeople;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Utils\HasProvider;

class ListPeopleTest extends TestCase
{
    use HasProvider;

    public $component;

    /**
     * @test
     * @dataProvider cepProvider
     * @covers \App\Http\Livewire\EditPerson::updated
     * @covers \App\Http\Livewire\EditPerson::fillAddress
     * @covers \App\Services\CepService::getAddressDataByCep
     * @covers \App\Services\CepService::getAddressDataMap
     */
    public function test_if_people_can_be_listed()
    {
        $people = Person::limit(50)->get();
        
        $component = Livewire::test(ListPeople::class)
        ->assertViewIs('livewire.person.list-people');
        
        foreach($people as $i => $person)
        {
            if($i < 10)
                $component->assertSeeHtml($person->company_name ?? $person->name);

            if($i >= 10)
                $component->assertDontSee($person->company_name ?? $person->name);
        }
    }

    public function test_if_people_can_be_searched_by_name_or_company_name()
    {
        $people = Person::limit(10)->get();
        
        $component = Livewire::test(ListPeople::class);

        foreach($people as $i => $person)
        {
            $component->set('filter', $person->company_name ?? $person->name)
            ->assertSee($person->company_name ?? $person->name);

            foreach($people as $k => $p)
            {
                if($i != $k)
                    $component->assertDontSee($p->company_name ?? $p->name);
            }
        }
    }

    public function test_if_number_of_rows_per_page_can_be_expended()
    {

    }
}