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
     * @test
     * @dataProvider personProvider
     */
    public function test_if_company_name_gets_filled_when_cnpj_is_filled(string $cnpj, string $expectedCompanyName)
    {
        $person = Person::first();
        
        $component = Livewire::test(EditPerson::class, ['person' => $person])
        ->set('cnpj', $cnpj)
        ->assertNotSet('companyName', $person->company_name)
        ->assertSet('companyName', $expectedCompanyName);
    }

    public function personProvider(): array
    {
        return [
            ['cnpj' => '07019231000196', 'expectedCompanyName' => 'KENERSON INDUSTRIA E COMERCIO DE PRODUTOS OPTICOS LTDA'],
        ];
    }
}
