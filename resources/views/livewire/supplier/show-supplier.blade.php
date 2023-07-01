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
        <div class="row">
            <div class="col-md-6 phones">
                @foreach($this->phones as $index => $phone)
                    <x-phone :phone="$phone" index="{{ $index }}"/>
                @endforeach
                <button wire:click="createPhone" class="btn btn-link">Adicionar</button>
            </div>
            <div class="col-md-6 emails">
                @foreach($this->emails as $index => $email)
                    <x-email :email="$email" index="{{ $index }}"/>
                @endforeach
                <button wire:click="createEmail" class="btn btn-link">Adicionar</button>
            </div>
        </div>
    </x-card.card>

    <x-card.card title="Contatos Adicionais">

    </x-card.card>
    <x-card.card title="Dados de Endereço">

    </x-card.card>
    <x-card.card title="Observação">

    </x-card.card>
</div>
