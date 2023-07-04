@isset($this->person->address)
<div class="field-set">
    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">CEP</label><sup>•</sup>
            <input wire:model="person.address.cep" value="{{ $this->person->address->cep }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
            @error('person.address.cep') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Logradouro</label><sup>•</sup>
            <input wire:model="person.address.address" value="{{ $this->person->address->address }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
            @error('address.address') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Número</label><sup>•</sup>
            <input wire:model="person.address.building_number" value="{{ $this->person->address->building_number }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
            @error('person.address.building_number') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Complemento</label>
            <input wire:model="person.address.complement" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
            @error('person.address.complement') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>
        <div class="row">
            <div class="col-lg-3 col-12">
                <label class="control-label">Bairro</label><sup>•</sup>
                <input wire:model="person.address.area" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                @error('person.address.area') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">Ponto de Referência</label>
                <input wire:model="person.address.reference_point" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                @error('person.address.reference_point') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">UF</label><sup>•</sup>
                <input list="uf" wire:model="person.address.city.uf" value="{{ $this->person?->address?->city?->uf }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                <datalist id="uf">
                    <option hidden>Selecione</option>
                    @foreach(App\Models\City::select('uf')->groupBy('uf') as $uf)
                        <option>{{ $uf->uf }}</option>
                    @endforeach
                </datalist>
                @error('person.address.city.uf') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12"><sup>•</sup>
                <label class="control-label">Cidade</label>
                <input wire:model="person.address.city.name" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                @error('person.address.city.name') <span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-12">
                <label class="control-label">Condomínio?</label><sup>•</sup>
                <select wire:model="person.address.is_condo" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    <option hidden>Selecione</option>
                    <option wire:model="person.address.is_condo" value="0" @if($this->person?->address?->is_condo == 0) selected @endif>Sim</option>
                    <option wire:model="person.address.is_condo" value="1" @if($this->person?->address?->is_condo == 1) selected @endif>Não</option>
                </select>
                @error('person.address.is_condo') <span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
</div>
@endisset