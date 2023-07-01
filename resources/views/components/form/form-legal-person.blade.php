@isset($this->personable)
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

    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">Indicador de Inscrição Estadual</label><sup>•</sup>
            <select wire:model="personable.ie_category" class="form-control form-control-sm" required>
                <option>Selecione</option>
                @foreach(App\Enums\Person\StateRegistrationCategory::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->label() }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Inscrição Estadual @if(App\Enums\Person\StateRegistrationCategory::tryFrom($this->personable?->ie_category)?->required())</label><sup>•</sup>@endif
            <input class="form-control form-control-sm" @if(App\Enums\Person\StateRegistrationCategory::tryFrom($this->personable?->ie_category)?->required()) {{ 'required' }} @else {{ 'disabled '}} @endif>
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Inscrição Municipal </label><sup>•</sup>
            <input class="form-control form-control-sm" required>
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Nome Fantasia</label><sup>•</sup>
            <input class="form-control form-control-sm" required>
        </div>
    </div>
@endisset