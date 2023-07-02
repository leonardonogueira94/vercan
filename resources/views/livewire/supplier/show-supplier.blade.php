<div>
    <x-card.card title="Dados do Fornecedor">
        <div class="row">
            <div class="col-12">
                <x-input.radio-group-from-enum wired="true" name="person.personable_type" :values="App\Enums\Person\PersonType::cases()"/>
            </div>
        </div>
        @if($person->personable_type == App\Enums\Person\PersonType::JURIDICA->class())
            <x-form.form-legal-person/>
        @elseif($person->personable_type == App\Enums\Person\PersonType::FISICA->class())
            <x-form.form-natural-person/>
        @endif
    </x-card.card>

    <x-card.card title="Contato Principal">
        @foreach(array_filter($this->contacts, fn($contact) => $contact['is_default'] == true) as $contact)
            <div class="row">
                <div class="col-md-6 phones">
                    @foreach(array_filter($this->phones, fn($phone) => $phone['contact'] == $contact) as $phone)
                        <x-phone :phone="$phone"/>
                    @endforeach
                    @if(request()->route()->getName() != 'supplier.show')
                        <button wire:click="createPhone({{ $contact['index'] }})" class="btn btn-link">Adicionar</button>
                    @endif
                </div>
                <div class="col-md-6 emails">
                    @foreach(array_filter($this->emails, fn($email) => $email['contact'] == $contact) as $email)
                        <x-email :email="$email"/>
                    @endforeach
                    @if(request()->route()->getName() != 'supplier.show')
                        <button wire:click="createEmail({{ $contact['index'] }})" class="btn btn-link">Adicionar</button>
                    @endif
                </div>
            </div>
        @endforeach
    </x-card.card>

    <button wire:click="createContact(false)" class="d-flex justify-content-end w-100 btn btn-link">ADICIONAR</button>

    <x-card.card title="Contatos Adicionais">
        @foreach(array_filter($this->contacts, fn($contact) => $contact['is_default'] == false) as $contact)
            <div class="row">
                <div class="col-lg-6 col-12">
                    <label class="control-label">Nome</label>
                    <input wire:model="contacts.contact_name" class="form-control form-control-sm" required>
                    @error('person.address.cep') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Empresa</label>
                    <input wire:model="person.address.address" class="form-control form-control-sm" required>
                    @error('address.address') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Cargo</label>
                    <input wire:model="person.address.building_number" class="form-control form-control-sm" required>
                    @error('person.address.building_number') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 phones">
                    @foreach(array_filter($this->phones, fn($phone) => $phone['contact'] == $contact) as $phone)
                        <x-phone :phone="$phone"/>
                    @endforeach
                    @if(request()->route()->getName() != 'supplier.show')
                        <button wire:click="createPhone({{ $contact['index'] }})" class="btn btn-link">Adicionar</button>
                    @endif
                </div>
                <div class="col-md-6 emails">
                    @foreach(array_filter($this->emails, fn($email) => $email['contact'] == $contact) as $email)
                        <x-email :email="$email"/>
                    @endforeach
                    @if(request()->route()->getName() != 'supplier.show')
                        <button wire:click="createEmail({{ $contact['index'] }})" class="btn btn-link">Adicionar</button>
                    @endif
                </div>
            </div>
        @endforeach
    </x-card.card>

    <x-card.card title="Dados de Endereço">
        <x-form.form-address-data/>
    </x-card.card>

    <x-card.card title="Observação">

    </x-card.card>

    @if(request()->route()->getName() == 'supplier.show')
        <a href="{{ route('supplier.edit', ['person' => $person]) }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Editar</a>
    @elseif(request()->route()->getName() == 'supplier.create')
        <button class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Cadastrar</button>
    @endif
</div>