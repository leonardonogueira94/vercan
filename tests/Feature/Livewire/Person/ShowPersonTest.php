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

    public function personProvider(): array
    {
        return [
            [Person::with('contacts.phones')->with('contacts.emails')->inRandomOrder()->first()]
        ];
    }
}
