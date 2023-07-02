<div clas="row">
    <div class="col-12">
        <div class="row email-row">
            <div class="col-6">
                <label class="control-label">Telefone</label><sup>•</sup>
                <input wire:model="phones.{{ $phone['contact']['index'] }}.phone" class="form-control form-control-sm" required>
            </div>
            <div class="col-6">
                <label class="control-label">Tipo</label><sup>•</sup>
                <select class="form-control form-control-sm" required>
                    <option value="">Selecione</option>
                    @foreach(App\Enums\Contact\ContactChannel::TELEFONE->tipos() as $case)
                        <option wire:model="phones.{{ $phone['contact']['index'] }}.type" value="{{ $case->value }}" @if($case->value == $phone['type']) {{ 'selected' }} @endif> {{ $case->label() }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>