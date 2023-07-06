<?php

namespace Tests\Feature\Livewire\Person;

use App\Enums\Person\PersonType;
use App\Http\Livewire\Person\EditPerson;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Person;
use App\Models\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Utils\FieldMap;
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
     * @dataProvider razaoProvider
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
     * @covers \App\Http\Livewire\EditPerson::retrieveContacts
     */
    public function if_form_gets_filled_with_person_data()
    {
        $people = Person::limit(30)->get();

        foreach($people as $person)
        {            
            $component = Livewire::test(EditPerson::class, ['person' => $person])->assertSet('type', $person->type)
            ->assertSet('person', $person);

            if($person->type == PersonType::JURIDICA->value)
                foreach(FieldMap::LEGAL_PERSON_FIELDS as $property => $column)
                    $component->assertSee($person->$column);

            if($person->type == PersonType::FISICA->value)
                foreach(FieldMap::NATURAL_PERSON_FIELDS as $property => $column)
                    $component->assertSee($person->$column);
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
            $component = Livewire::test(EditPerson::class, ['person' => $person]);

            foreach(FieldMap::ADDRESS_FIELDS as $column)
                $component->assertSee($person->address->$column);

            $component->assertSee($person->address->city->uf)
            ->assertSee($person->address->city->name);
        }
    }

    public function if_it_is_able_to_add_contacts()
    {
        $people = Person::with('contacts.phones')->with('contacts.emails')->limit(20)->get();

        foreach($people as $person)
        {

        }
    }

    public function if_it_is_able_to_remove_contacts()
    {
        $people = Person::with('contacts.phones')->with('contacts.emails')->limit(20)->get();

        foreach($people as $person)
        {

        }
    }

    /**
     * @test
     * @large
     * @covers \App\Http\Livewire\EditPerson::updateContactsData
     * @covers \App\Http\Livewire\EditPerson::submit
     */
    public function if_it_is_able_to_update_contacts()
    {
        $people = Person::with('contacts')->limit(20)->get();

        foreach($people as $person)
        {
            foreach($person->contacts as $contactIndex => $oldContact)
            {
                $component = Livewire::test(EditPerson::class, ['person' => $person]);

                if($oldContact->is_default == 1)
                    continue;
                    
                $newContact = Contact::factory()->make();

                $component->set("contacts.$contactIndex.contact_name", $newContact->contact_name)
                ->set("contacts.$contactIndex.company_name", $newContact->company_name)
                ->set("contacts.$contactIndex.job_title", $newContact->job_title)
                ->call('submit')
                ->assertSeeHtml('value="'.e($newContact->contact_name).'"')
                ->assertSeeHtml('value="'.e($newContact->company_name).'"')
                ->assertSeeHtml('value="'.e($newContact->job_title).'"')
                ->assertDontSeeHtml('value="'.e($oldContact->contact_name).'"')
                ->assertDontSeeHtml('value="'.e($oldContact->company_name).'"')
                ->assertDontSeeHtml('value="'.e($oldContact->job_title).'"');
            }
        }
    }

    /**
     * @test
     * @large
     * @covers \App\Http\Livewire\EditPerson::updateContactsData
     * @covers \App\Http\Livewire\EditPerson::submit
     */
    public function if_it_is_able_to_update_emails()
    {
        $people = Person::with('contacts.emails')->limit(20)->get();

        foreach($people as $person)
        {
            foreach($person->contacts as $contactIndex => $contact)
            {
                foreach($contact->emails as $emailIndex => $oldEmail)
                {
                    $component = Livewire::test(EditPerson::class, ['person' => $person]);

                    $newEmail = Email::factory()->make();

                    $component->set("contacts.$contactIndex.emails.$emailIndex.email", $newEmail->email)
                    ->set("contacts.$contactIndex.emails.$emailIndex.type", $newEmail->type->value)
                    ->call('submit')
                    ->assertSeeHtml('value="'.$newEmail->email.'"')
                    ->assertSeeHtml('value="'.e($newEmail->type).'"');
                }
            }
        }
    }

    /**
     * @test
     * @large
     * @covers \App\Http\Livewire\EditPerson::updateContactsData
     * @covers \App\Http\Livewire\EditPerson::submit
     */
    public function if_it_is_able_to_update_phones()
    {
        $people = Person::with('contacts.phones')->limit(20)->get();

        foreach($people as $person)
            foreach($person->contacts as $contactIndex => $contact)
                foreach($contact->phones as $phoneIndex => $oldPhone)
                {
                    $component = Livewire::test(EditPerson::class, ['person' => $person]);

                    $newPhone = Phone::factory()->make();

                    $component->set("contacts.$contactIndex.phones.$phoneIndex.phone", $newPhone->phone)
                    ->set("contacts.$contactIndex.phones.$phoneIndex.type", $newPhone->type)
                    ->call('submit')
                    ->assertSeeHtml('value="'.$newPhone->phone.'"')
                    ->assertSeeHtml('value="'.$newPhone->type->value.'"');
                }
    }

    /**
     * @test
     * @large
     * @covers \App\Http\Livewire\EditPerson::updateContactsData
     * @covers \App\Http\Livewire\EditPerson::submit
     */
    public function if_it_is_able_to_add_emails()
    {
        $people = Person::with('contacts.phones')->limit(20)->get();

        foreach($people as $person)
        {
            foreach($person->contacts as $contactIndex => $contact)
            {
                foreach($contact->phones as $phoneIndex => $oldPhone)
                {
                    $component = Livewire::test(EditPerson::class, ['person' => $person]);

                    $newPhone = Phone::factory()->make();

                    $component->set("contacts.$contactIndex.phones.$phoneIndex.phone", $newPhone->phone)
                    ->set("contacts.$contactIndex.phones.$phoneIndex.type", $newPhone->type->value)
                    ->call('submit')
                    ->assertSeeHtml('value="'.$newPhone->phone.'"')
                    ->assertSeeHtml('value="'.$newPhone->type.'"');
                }
            }
        }
    }

    /**
     * @test
     * @large
     * @covers \App\Http\Livewire\EditPerson::updatePersonData
     * @covers \App\Http\Livewire\EditPerson::updateAddressData
     * @covers \App\Http\Livewire\EditPerson::submit
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
                    $component->set($property, $otherPeople->get($i)->$column);

            if($person->type == PersonType::FISICA->value)
                foreach(FieldMap::LEGAL_PERSON_FIELDS as $property => $column)
                    $component->set($property, $otherPeople->get($i)->$column);

            foreach(FieldMap::PERSON_COMMON_FIELDS as $property => $column)
                $component->set($property, $otherPeople->get($i)->$column);

            foreach(FieldMap::ADDRESS_FIELDS as $property => $column)
                if(!in_array($property, ['uf', 'city']))
                    $component->set($property, $otherPeople->get($i)->$column);
                else
                    $component->set($property, $otherPeople->get($i)->address->$column);
            
            $component->call('submit');

            $legalPersonData = [];

            $naturalPersonData = [];

            $commonData = [
                'id' => $person->id,
                'is_active' => $otherPeople->get($i)->is_active,
                'observation' => $otherPeople->get($i)->observation,
            ];

            foreach(FieldMap::LEGAL_PERSON_FIELDS as $property => $column)
                $legalPersonData[$column] = $otherPeople->get($i)->$column;

            foreach(FieldMap::NATURAL_PERSON_FIELDS as $property => $column)
                $legalPersonData[$column] = $otherPeople->get($i)->$column;

            if($person->type == PersonType::JURIDICA->value)
                $this->assertDatabaseHas('people', $legalPersonData + $commonData);

            if($person->type == PersonType::FISICA->value)
                $this->assertDatabaseHas('people', $naturalPersonData + $commonData);

            if($person->type == PersonType::JURIDICA->value)
                foreach(FieldMap::LEGAL_PERSON_FIELDS as $property => $column)
                    $component->assertSeeHtml($otherPeople->get($i)->$column);

            if($person->type == PersonType::FISICA->value)
                foreach(FieldMap::NATURAL_PERSON_FIELDS as $property => $column)
                    $component->assertSeeHtml($otherPeople->get($i)->$column);

            foreach(FieldMap::PERSON_COMMON_FIELDS as $property => $column)
                $component->assertSeeHtml($otherPeople->get($i)->$column);
        }
    }
}
