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
        <x-form.form-default-contact/>
    </x-card.card>

    @if(request()->route()->getName() != 'supplier.show')
        <button wire:click="createContact(false)" class="d-flex justify-content-end w-100 btn btn-link">ADICIONAR</button>
    @endif

    <x-card.card title="Contatos Adicionais">
        <x-form.form-additional-contact/>
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