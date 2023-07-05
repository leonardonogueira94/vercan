
<div class="field-set">
    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">CEP</label><sup>•</sup>
            <input wire:model.debounce.500ms="cep" value="{{ $this->cep }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
            @error('cep') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Logradouro</label><sup>•</sup>
            <input wire:model.debounce.500ms="address" value="{{ $this->address }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
            @error('address') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Número</label><sup>•</sup>
            <input wire:model.debounce.500ms="buildingNumber" value="{{ $this->buildingNumber }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
            @error('buildingNumber') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Complemento</label>
            <input wire:model.debounce.500ms="complement" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
            @error('complement') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>
        <div class="row">
            <div class="col-lg-3 col-12">
                <label class="control-label">Bairro</label><sup>•</sup>
                <input wire:model.debounce.500ms="area" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                @error('area') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">Ponto de Referência</label>
                <input wire:model.debounce.500ms="referencePoint" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                @error('referencePoint') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">UF</label><sup>•</sup>
                <select wire:model.debounce.500ms="uf" value="{{ $this->uf }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    <option hidden>Selecione</option>
                    @foreach($this->ufs as $uf)
                        <option value="{{ $uf->uf }}" @if($this->uf == $uf->uf) selected @endif>{{ $uf->uf }}</option>
                    @endforeach
                </select>
                @error('uf') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12"><sup>•</sup>
                <label class="control-label">Cidade</label>
                <select wire:model.debounce.500ms="city" value="{{ $this->city }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    <option hidden>Selecione</option>
                        @foreach($this->cities as $city)
                            <option value="{{ $city->name }}" @if($this->city == $city->name) selected @endif>{{ $city->name }}</option>
                        @endforeach
                </select>
                @error('city') <span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-12">
                <label class="control-label">Condomínio?</label><sup>•</sup>
                <select wire:model.debounce.500ms="isCondo" class="form-control form-control-sm" value="{{ $this->isCondo }}" required @if($this->disableInputs) disabled @endif>
                    <option hidden>Selecione</option>
                    <option value="1" @if($this->isCondo == 1) selected @endif>Sim</option>
                    <option value="0" @if($this->isCondo == 0) selected @endif>Não</option>
                </select>
                @error('isCondo') <span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
</div>