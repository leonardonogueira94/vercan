@props(['readonly' => true])
@isset($this->person)
    @if($this->person->type == App\Enums\Person\PersonType::JURIDICA->value)
        <div class="field-set">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">CNPJ</label><sup>•</sup>
                    <input wire:model="person.cnpj" class="form-control form-control-sm" required @if($readonly) disabled @endif>
                    @error('person.cnpj') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-6 col-12">
                    <label class="control-label">Razão Social</label><sup>•</sup>
                    <input wire:model="person.company_name" class="form-control form-control-sm" required @if($readonly) disabled @endif>
                    @error('person.company_name') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Nome Fantasia</label><sup>•</sup>
                    <input wire:model="person.trading_name" class="form-control form-control-sm" required @if($readonly) disabled @endif>
                    @error('person.trading_name') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">Indicador de Inscrição Estadual</label><sup>•</sup>
                    <select wire:model="person.ie_category" class="form-control form-control-sm" required @if($readonly) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Person\StateRegistrationCategory::cases() as $case)
                            <option value="{{ $case->value }}">{{ $case->label() }}</option>
                        @endforeach
                    </select>
                    @error('person.ie_category') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Inscrição Estadual</label> @if($this->person?->ie_category?->required())<sup>•</sup>@endif
                    <input wire:model="person.ie" class="form-control form-control-sm" @if($this->person?->ie_category?->required()) {{ 'required' }} @else {{ 'disabled '}} @endif @if($readonly) disabled @endif>
                    @error('person.ie') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Inscrição Municipal</label>
                    <input wire:model="person.im" class="form-control form-control-sm" required @if($readonly) disabled @endif>
                    @error('person.im') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Situação CNPJ</label>
                    <input wire:model="person.cnpj_status" class="form-control form-control-sm" id="cnpj" required @if($readonly) disabled @endif>
                    @error('person.cnpj_status') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">Recolhimento</label><sup>•</sup>
                    <select wire:model="person.tax_type" class="form-control form-control-sm" required @if($readonly) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Person\TaxCollectionType::cases() as $case)
                            <option value="{{ $case->value }}">{{ $case->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Ativo</label><sup>•</sup>
                    <select wire:model="person.is_active" class="form-control form-control-sm" required @if($readonly) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Person\PersonStatus::cases() as $case)
                            <option value="{{ $case->value }}" @if($this->person->is_active == $case->value) {{ 'selected' }} @endif> {{ $case->label() }} </option>
                        @endforeach
                    </select>
                    @error('person.is_active') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    @endif
@endisset