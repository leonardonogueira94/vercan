<div>
    <x-card.card title="Dados do Fornecedor">
        <div class="row">
            <div class="col-12">
                <x-input.radio-group-from-enum wired="true" name="person.personable_type" :values="App\Enums\Person\PersonType::cases()"/>
            </div>
        </div>
        @if($person->personable_type == App\Enums\Person\PersonType::JURIDICA->value)
            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">CNPJ</label><sup>•</sup>
                    <input class="form-control form-control-sm" required>
                </div>
                <div class="col-lg-6 col-12">
                    <label class="control-label">Razão Social</label><sup>•</sup>
                    <input class="form-control form-control-sm" required>
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Nome Fantasia</label><sup>•</sup>
                    <input class="form-control form-control-sm" required>
                </div>
            </div>
        @elseif($person->personable_type == App\Enums\Person\PersonType::FISICA->value)
            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">CPF</label><sup>•</sup>
                    <input class="form-control form-control-sm" required>
                </div>
                <div class="col-lg-6 col-12">
                    <label class="control-label">Nome</label><sup>•</sup>
                    <input class="form-control form-control-sm" required>
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Apelido
                    <input class="form-control form-control-sm">
                </div>
            </div>
        @endif
    </x-card.card>
    <x-card.card title="Contato Principal">

    </x-card.card>
    <x-card.card title="Contatos Adicionais">

    </x-card.card>
    <x-card.card title="Dados de Endereço">

    </x-card.card>
    <x-card.card title="Observação">

    </x-card.card>
</div>
