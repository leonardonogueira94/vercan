<div>
    <div>
        <x-alerts/>
        <x-card.card title="Dados do Fornecedor">
            <div class="row">
                <div class="col-12">
                    <x-input.radio-group-from-enum wired="true" name="type" :values="App\Enums\Person\PersonType::cases()"/>
                </div>
            </div>
            <x-form.form-legal-person/>
            <x-form.form-natural-person/>
        </x-card.card>

        <x-card.card title="Contato Principal">
            <x-form.form-default-contact/>
        </x-card.card>

        <button wire:click="addContact()" class="d-flex justify-content-end w-100 btn btn-link" @if($this->disableInputs) disabled @endif>ADICIONAR</button>

        <x-card.card title="Contatos Adicionais">
            <x-form.form-additional-contact/>
        </x-card.card>

        <x-card.card title="Dados de Endereço">
            <x-form.form-address-data/>
        </x-card.card>

        <x-card.card title="Observação">
            <x-observation/>
        </x-card.card>

        <form wire:submit.prevent="submit" method="POST">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
        </form>
    </div>
</div>