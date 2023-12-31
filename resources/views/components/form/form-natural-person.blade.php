<div class="field-set @if($this->type != App\Enums\Person\PersonType::FISICA->value) d-none @endif">
    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">CPF</label><sup>•</sup>
            <input wire:model.defer="cpf" value="{{ $this->cpf }}" class="form-control form-control-sm cpf" required @if($this->disableInputs) disabled @endif>
            @error('cpf') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-6 col-12">
            <label class="control-label">Nome</label><sup>•</sup>
            <input wire:model.debounce.500ms="name" value="{{ $this->name }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
            @error('name') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Apelido</label>
            <input wire:model.debounce.500ms="alias" value="{{ $this->alias }}" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
            @error('alias') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">RG</label><sup>•</sup>
            <input wire:model.debounce.500ms="rg" value="{{ $this->rg }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
            @error('rg') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Ativo</label><sup>•</sup>
            <select wire:model.debounce.500ms="personStatus" value="{{ $this->personStatus }}" class="form-control form-control-sm" required @if($this->disableInputs) disabled @endif>
                <option hidden>Selecione</option>
                @foreach(App\Enums\Person\PersonStatus::cases() as $case)
                    <option value="{{ $case->value }}" @if($this->personStatus == $case->value) selected @endif>{{ $case->label() }}</option>
                @endforeach
            </select>
            @error('personStatus') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>
</div>
@push('js')
    <script>
        $('body').on('keyup', '.cpf', function(e) {
            var cpf = $(this);
            var cpfMask = new Inputmask("999.999.999-99")
            cpfMask.mask(cpf);
            cpf.keyup((e) => {
                let cpf = e.target.value;
                @this.set('cpf', cpf, true);
            })
        })
    </script>
@endpush