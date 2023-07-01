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
        <select class="form-control form-control-sm" required>
            <option>Selecione</option>
            @foreach(App\Enums\Person\StateRegistrationCategory::cases() as $case)
                <option>{{ $case->label() }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-3 col-12">
        <label class="control-label">Inscrição Estadual</label><sup>•</sup>
        <input class="form-control form-control-sm" required>
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