<div>
    <x-card.card title="Dados do Fornecedor">
        <div class="row">
            <div class="col-12">
                <x-input.radio-group-from-enum wired="true" name="person.type" :values="App\Enums\Person\PersonType::cases()"/>
            </div>
        </div>
        @if($person->type == App\Enums\Person\PersonType::JURIDICA->value)
            <x-form.form-legal-person readonly="true"/>
        @elseif($person->type == App\Enums\Person\PersonType::FISICA->value)
            <x-form.form-natural-person readonly="true"/>
        @endif
    </x-card.card>

    <x-card.card title="Contato Principal">
        <x-form.form-default-contact/>
    </x-card.card>

    <button wire:click="createContact(false)" class="d-flex justify-content-end w-100 btn btn-link" @if($this->disableInputs) disabled @endif>ADICIONAR</button>

    <x-card.card title="Contatos Adicionais">
        <x-form.form-additional-contact/>
    </x-card.card>

    <x-card.card title="Dados de Endereço">
        <x-form.form-address-data/>
    </x-card.card>

    <x-card.card title="Observação">
        <x-observation/>
    </x-card.card>

    <button class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Cadastrar</button>
</div>