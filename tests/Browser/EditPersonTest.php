<?php

namespace Tests\Browser;

use App\Enums\Person\PersonType;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditPersonTest extends DuskTestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    protected function hasHeadlessDisabled(): bool
    {
        return true;
    }

    /**
     * @test
     * @large
     */
    public function if_cnpj_input_gets_masked()
    {
        $people = Person::where('type', PersonType::JURIDICA->value)->limit(5)->get();

        foreach($people as $person)
        {   
            $this->browse(function (Browser $browser) use($person){
                $browser->resize(1024, 800)
                ->loginAs(1)
                ->visitRoute('person.edit', ['person' => $person])
                ->waitFor('.cnpj');

                $maskService = app('App\Services\MaskService');
                $unmaskedCnpj = fake()->numerify('##############');

                $browser->scrollIntoView('.cnpj')
                ->click('.cnpj')
                ->type('.cnpj', $unmaskedCnpj);

                $maskedCnpj = $maskService->maskCnpj($unmaskedCnpj);

                $browser->click('.company-name')
                ->type('.company-name', fake()->company())
                ->assertValue('.cnpj', $maskedCnpj);
            });
        }
    }

    /**
     * @test
     * @large
     */
    public function if_cep_input_gets_masked()
    {
        $people = Person::limit(5)->get();

        foreach($people as $person)
        {   
            $this->browse(function (Browser $browser) use($person){
                $browser->resize(1024, 800)
                ->loginAs(1)
                ->visitRoute('person.edit', ['person' => $person])
                ->waitFor('.cep');

                $maskService = app('App\Services\MaskService');
                $unmaskedCep = fake()->numerify('########');

                $browser->scrollIntoView('.cep')
                ->click('.cep')
                ->type('.cep', $unmaskedCep);

                $maskedCep = $maskService->maskCep($unmaskedCep);

                $browser->click('.address')
                ->type('.address', fake()->streetName())
                ->assertValue('.cep', $maskedCep);
            });
        }
    }

    public function test_if_cellphone_input_gets_masked()
    {
        $people = Person::with('phones')->limit(5)->whereRelation('phones', 'type', 'cellphone')->get();

        foreach($people as $person)
        {   
            $this->browse(function (Browser $browser) use($person){
                $browser->resize(1024, 800)
                ->loginAs(1)
                ->visitRoute('person.edit', ['person' => $person])
                ->waitFor('.cellphone');

                $maskService = app('App\Services\MaskService');
                $unmaskedCellphone = fake()->numerify('###########');

                $browser->scrollIntoView('.cellphone')
                ->click('.cellphone')
                ->type('.cellphone', $unmaskedCellphone);

                $maskedCellphone = $maskService->maskCellphone($unmaskedCellphone);

                $browser->click('.phone-type')
                ->select('.phone-type')
                ->assertValue('.cellphone', $maskedCellphone);
            });
        }
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
