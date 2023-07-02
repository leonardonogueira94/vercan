@isset($this->personable)
<div class="field-set">
    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">CNPJ</label><sup>•</sup>
            <input wire:model="personable.cnpj" class="form-control form-control-sm" required>
            @error('personable.cnpj') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-6 col-12">
            <label class="control-label">Razão Social</label><sup>•</sup>
            <input wire:model="personable.company_name" class="form-control form-control-sm" required>
            @error('personable.company_name') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Nome Fantasia</label><sup>•</sup>
            <input wire:model="personable.trading_name" class="form-control form-control-sm" required>
            @error('personable.trading_name') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">Indicador de Inscrição Estadual</label><sup>•</sup>
            <select wire:model="personable.ie_category" class="form-control form-control-sm" required>
                <option value="">Selecione</option>
                @foreach(App\Enums\Person\StateRegistrationCategory::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->label() }}</option>
                @endforeach
            </select>
            @error('personable.ie_category') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Inscrição Estadual</label> @if($this->personable?->ie_category?->required())<sup>•</sup>@endif
            <input wire:model="personable.ie" class="form-control form-control-sm" @if($this->personable?->ie_category?->required()) {{ 'required' }} @else {{ 'disabled '}} @endif>
            @error('personable.ie') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Inscrição Municipal</label>
            <input wire:model="personable.im" class="form-control form-control-sm" required>
            @error('personable.im') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Situação CNPJ</label>
            <input wire:model="personable.cnpj_status" class="form-control form-control-sm" id="cnpj" required>
            @error('personable.cnpj_status') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">Recolhimento</label><sup>•</sup>
            <select wire:model="personable.tax_type" class="form-control form-control-sm" required>
                <option hidden>Selecione</option>
                @foreach(App\Enums\Person\TaxCollectionType::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->label() }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Ativo</label><sup>•</sup>
            <select wire:model="person.is_active" class="form-control form-control-sm" required>
                <option hidden>Selecione</option>
                @foreach(App\Enums\Person\PersonStatus::cases() as $case)
                    <option value="{{ $case->value }}" @if($this->person->is_active == $case->value) {{ 'selected' }} @endif> {{ $case->label() }} </option>
                @endforeach
            </select>
            @error('personable.is_active') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>
</div>
@endisset