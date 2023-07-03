<div clas="row">
    <div class="col-12">
        <div class="row email-row">
            <div class="col-6">
                <label class="control-label">Telefone</label>@if($phone == reset($this->phones)) <sup>•</sup> @endif
                <input wire:model="phones.{{ $phone['index'] }}.phone" class="form-control form-control-sm"
                @if($phone == reset($this->phones)) required @endif>
            </div>
            <div class="col-6">
                <label class="control-label">Tipo</label>@if($phone == reset($this->phones))<sup>•</sup>@endif
                <select class="form-control form-control-sm" @if($phone == reset($this->phones)) required @endif>
                    <option hidden>Selecione</option>
                    @foreach(App\Enums\Contact\ContactChannel::TELEFONE->tipos() as $case)
                        <option wire:model="phones.{{ $phone['index'] }}.type" value="{{ $case->value }}" 
                        @if($case->value == $phone['type']) {{ 'selected' }} @endif> {{ $case->label() }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>