@isset($this->personable)
<div class="field-set">
    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">CEP</label><sup>•</sup>
            <input wire:model="address.cep" class="form-control form-control-sm" required>
            @error('person.address.cep') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Logradouro</label><sup>•</sup>
            <input wire:model="person.address.address" class="form-control form-control-sm" required>
            @error('address.address') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Número</label><sup>•</sup>
            <input wire:model="person.address.building_number" class="form-control form-control-sm" required>
            @error('person.address.building_number') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Complemento</label>
            <input wire:model="person.address.complement" class="form-control form-control-sm" required>
            @error('person.address.complement') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>
        <div class="row">
            <div class="col-lg-3 col-12">
                <label class="control-label">Bairro</label><sup>•</sup>
                <input wire:model="person.address.area" class="form-control form-control-sm" required>
                @error('person.address.area') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">Ponto de Referência</label>
                <input wire:model="person.address.reference_point" class="form-control form-control-sm" required>
                @error('person.address.reference_point') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">UF</label><sup>•</sup>
                <input list="uf" wire:model="person.address.city.state_id" class="form-control form-control-sm" required>
                <datalist id="uf">
                    <option value="">Selecione</option>
                    @foreach(App\Models\State::all() as $state)
                        <option value="{{ $state->acronym }}">{{ $state->name }}</option>
                    @endforeach
                </datalist>
                @error('person.address.city.state_id') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12"><sup>•</sup>
                <label class="control-label">Cidade</label>
                <input wire:model="person.address.city_id" class="form-control form-control-sm" required>
                @error('person.address.city_id') <span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-12">
                <label class="control-label">Condomínio?</label><sup>•</sup>
                <input wire:model="person.address.is_condo" class="form-control form-control-sm" required>
                @error('person.address.is_condo') <span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
</div>
@endisset