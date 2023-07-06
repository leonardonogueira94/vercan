<?php

namespace Tests\Feature\Livewire\Person;

use App\Enums\Person\PersonType;
use App\Http\Livewire\Person\EditPerson;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Person;
use App\Models\Phone;
use App\Services\MaskService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Utils\FieldMap;
use Tests\Utils\HasProvider;

class EditPersonTest extends TestCase
{
    use HasProvider, RefreshDatabase;

    private MaskService $maskService;

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
        $people = Person::limit(30)->get();

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
            $component = Livewire::test(EditPerson::class, ['person' => $person])
            ->assertSee($person->address->city->uf)
            ->assertSee($person->address->city->name)
            ->assertSee($person->address->cep)
            ->assertSee($person->address->address)
            ->assertSee($person->address->building_number)
            ->assertSee($person->address->complement)
            ->assertSee($person->address->area)
            ->assertSee($person->address->reference_point)
            ->assertSee($person->address->is_condo);
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
        $people = Person::with('contacts.phones')->with('contacts.emails')->limit(20)->get();

        foreach($people as $person)
        {
            $component = Livewire::test(EditPerson::class, ['person' => $person]);

            foreach($person->contacts->where('is_default', false) as $contactIndex => $contact)
            {
                $newContact = Contact::factory()->make()->toArray();

                $newContact['id'] = $contact->id;

                $component->set("contacts.$contactIndex", $newContact);

                foreach($contact->phones as $phoneIndex => $phone)
                {
                    $newPhone = Phone::factory()->make()->toArray();

                    $newPhone['id'] = $phone->id;

                    $component->set("contacts.$contactIndex.phones.$phoneIndex", $newPhone);
                }

                foreach($contact->emails as $emailIndex => $email)
                {
                    $newEmail = Email::factory()->make()->toArray();

                    $newEmail['id'] = $email->id;

                    $component->set("contacts.$contactIndex.phones.$emailIndex", $newEmail);
                }
            }

            $component->call('submit');
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
