    @if($this->type == App\Enums\Person\PersonType::FISICA->value)
        <div class="field-set">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">CPF</label><sup>•</sup>
                    <input wire:model.debounce.500ms="cpf" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    @error('cpf') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-6 col-12">
                    <label class="control-label">Nome</label><sup>•</sup>
                    <input wire:model.debounce.500ms="name" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    @error('name') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Apelido</label>
                    <input wire:model.debounce.500ms="alias" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                    @error('alias') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">RG</label><sup>•</sup>
                    <input wire:model.debounce.500ms="rg" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    @error('rg') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Ativo</label><sup>•</sup>
                    <select wire:model.debounce.500ms="personStatus" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Person\PersonStatus::cases() as $case)
                            <option value="{{ $case->value }}" @if($this->personStatus == $case->value) selected @endif>{{ $case->label() }}</option>
                        @endforeach
                    </select>
                    @error('personStatus') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    @endif