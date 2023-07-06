<?php

namespace Tests\Feature\Livewire\Person;

use App\Http\Livewire\Person\ShowPerson;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Utils\HasProvider;

class ShowPersonTest extends TestCase
{
    use HasProvider;

    /**
     * @test
     * @covers \App\Http\Livewire\ShowPerson::retrieveContacts
     */
    public function test_if_contacts_can_be_retrivied()
    {
        $person = Person::inRandomOrder()->first();

        $component = Livewire::test(ShowPerson::class, ['person' => $person]);
        
        foreach($person->contacts as $contact)
        {
            /* if($contact->is_default)
                $component->assertSee($contact->contact_name)
                ->assertSee($contact->company_name)
                ->assertSee($contact->job_title); */

            foreach($contact->phones as $phone)
                $component->assertSee($phone->phone)
                ->assertSee($phone->type);

            foreach($contact->emails as $email)
                $component->assertSee($email->email)
                ->assertSee($email->type);
        }
    }
}
