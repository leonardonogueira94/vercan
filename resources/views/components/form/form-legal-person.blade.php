@isset($this->type)
    @if($this->type == App\Enums\Person\PersonType::JURIDICA->value)
        <div class="field-set">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">CNPJ</label><sup>•</sup>
                    <input wire:model.debounce.500ms="cnpj" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    @error('cnpj') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-6 col-12">
                    <label class="control-label">Razão Social</label><sup>•</sup>
                    <input wire:model.debounce.500ms="companyName" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    @error('companyName') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Nome Fantasia</label><sup>•</sup>
                    <input wire:model.debounce.500ms="tradingName" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    @error('tradingName') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">Indicador de Inscrição Estadual</label><sup>•</sup>
                    <select wire:model.debounce.500ms="stateRegistrationCategory" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Person\StateRegistrationCategory::cases() as $case)
                            <option value="{{ $case }}" @if($this->stateRegistrationCategory?->value == $case->value) {{ 'selected' }} @endif>{{ $case->label() }}</option>
                        @endforeach
                    </select>
                    @error('ie_category') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Inscrição Estadual</label> @if($this->stateRegistrationCategory?->required())<sup>•</sup>@endif
                    <input wire:model.debounce.500ms="ie" class="form-control form-control-sm" @if($this->stateRegistrationCategory?->required()) {{ 'required' }} @else {{ 'disabled '}} @endif @if($this->disableInputs) disabled @endif>
                    @error('ie') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Inscrição Municipal</label>
                    <input wire:model.debounce.500ms="im" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                    @error('im') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Situação CNPJ</label>
                    <input wire:model.debounce.500ms="cnpjStatus" class="form-control form-control-sm" id="cnpj" required @if($this->disableInputs) disabled @endif>
                    @error('cnpjStatus') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-12">
                    <label class="control-label">Recolhimento</label><sup>•</sup>
                    <select wire:model.debounce.500ms="taxCollectionType" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Person\TaxCollectionType::cases() as $case)
                            <option value="{{ $case->value }}">{{ $case->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-12">
                    <label class="control-label">Ativo</label><sup>•</sup>
                    <select wire:model.debounce.500ms="personStatus" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Person\PersonStatus::cases() as $case)
                            <option value="{{ $case->value }}" @if($this->personStatus == $case->value) {{ 'selected' }} @endif> {{ $case->label() }} </option>
                        @endforeach
                    </select>
                    @error('personStatus') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    @endif
@endisset
{{-- @once
    @push('js')
        <script>
            var cnpj = $('#cnpj');
            var cnpjMask = new Inputmask("99.999.999/9999-99");
            cnpjMask.mask(cnpj);
            cnpj.keyup((e) => {
                let cnpj = e.target.value;
                @this.set('person.cnpj', cnpj, true);
            })

            var phoneMask = new Inputmask("(99) 9999-9999");
            $('body').on('keyup', '.phone-input', function(e) {
                phoneMask.mask($(this));
                let phone = e.target.value;
                @this.set($(this).attr('wire:model.defer'), phone, true);
            });
        </script>
    @endpush
@endonce --}}