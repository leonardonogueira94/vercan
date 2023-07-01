@isset($this->personable)
<div class="field-set">
    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">CPF</label><sup>•</sup>
            <input wire:model="personable.cpf" class="form-control form-control-sm" required>
            @error('personable.cpf') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-6 col-12">
            <label class="control-label">Nome</label><sup>•</sup>
            <input wire:model="personable.name" class="form-control form-control-sm" required>
            @error('personable.name') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Apelido</label>
            <input wire:model="personable.alias" class="form-control form-control-sm">
            @error('personable.alias') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">RG</label><sup>•</sup>
            <input wire:model="personable.rg" class="form-control form-control-sm" required>
            @error('personable.rg') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Ativo</label><sup>•</sup>
            <select wire:model="person.is_active" class="form-control form-control-sm" required>
                <option value="">Selecione</option>
                @foreach(App\Enums\Person\PersonStatus::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->label() }}</option>
                @endforeach
            </select>
            @error('person.is_active') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>
</div>
@endisset