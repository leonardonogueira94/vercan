@isset($this->personable)
<div class="field-set">
    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">CPF</label><sup>•</sup>
            <input class="form-control form-control-sm" required>
        </div>
        <div class="col-lg-6 col-12">
            <label class="control-label">Nome</label><sup>•</sup>
            <input class="form-control form-control-sm" required>
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Apelido</label>
            <input class="form-control form-control-sm">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-12">
            <label class="control-label">RG</label><sup>•</sup>
            <input class="form-control form-control-sm" required>
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Ativo</label><sup>•</sup>
            <select wire:model="personable.is_active" class="form-control form-control-sm" required>
                <option value="">Selecione</option>
                @foreach(App\Enums\Person\PersonStatus::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->label() }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
@endisset