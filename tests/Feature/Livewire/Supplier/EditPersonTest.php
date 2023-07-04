<?php

namespace Tests\Feature\Livewire\Supplier;

use App\Http\Livewire\Person\EditPerson;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditPersonTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(EditPerson::class);

        $component->assertStatus(200);
    }

    /**
     * @dataProvider personProvider
     * @covers App\Http\Livewire\Person\EditPerson::fillPersonData
     */
    public function test_if_company_name_gets_filled_when_cnpj_is_filled(Person $person, string $cnpj)
    {
        $component = Livewire::test(EditPerson::class, ['person' => $person]);

        $component->set('person.cnpj', $cnpj)
        ->assertNotSet('person.company_name', )

    }

    public function personProvider(): array
    {
        return [
            [Person::make(), 'cnpj' => 07019231000196],
        ];
    }
}
