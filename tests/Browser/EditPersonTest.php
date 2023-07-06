<?php

namespace Tests\Browser;

use App\Models\Person;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditPersonTest extends DuskTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'john.doe@gmail.com')
                    ->type('password', 'password')
                    ->click('button[type="submit"]');
        });
    }


    public function test_if_forms_gets_filled_with_person_data(Person $person)
    {
        $component = Livewire::test(EditPerson::class, ['person' => $person])
        ->set('cnpj', $cnpj)
        ->assertNotSet('companyName', $person->company_name)
        ->assertSet('companyName', $expectedCompanyName);
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
