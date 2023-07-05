@isset($this->person)
    @if($this->person->type == App\Enums\Person\PersonType::FISICA->value)
        <div class="field-set">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">CPF</label><sup>•</sup>
                    <input wire:model.debounce.500ms="person.cpf" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    @error('person.cpf') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-6 col-12">
                    <label class="control-label">Nome</label><sup>•</sup>
                    <input wire:model.debounce.500ms="person.name" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    @error('person.name') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Apelido</label>
                    <input wire:model.debounce.500ms="person.alias" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                    @error('person.alias') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">RG</label><sup>•</sup>
                    <input wire:model.debounce.500ms="person.rg" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    @error('person.rg') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Ativo</label><sup>•</sup>
                    <select wire:model.debounce.500ms="person.is_active" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Person\PersonStatus::cases() as $case)
                            <option value="{{ $case->value }}" @if($this->person->is_active == $case->value) selected @endif>{{ $case->label() }}</option>
                        @endforeach
                    </select>
                    @error('person.is_active') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    @endif
@endisset