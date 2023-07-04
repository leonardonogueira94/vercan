<div clas="row">
    <div class="col-12">
        <div class="row email-row">
            <div class="col-6">
                <label class="control-label">Telefone</label>
                <input wire:model="person.contacts.{{ $contactIndex }}.phones.{{ $phoneIndex }}.phone" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
            </div>
            <div class="col-6">
                <label class="control-label">Tipo</label>
                <select wire:model="person.contacts.{{ $contactIndex }}.phones.{{ $phoneIndex }}.type" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                    <option hidden>Selecione</option>
                    @foreach(App\Enums\Contact\ContactChannel::TELEFONE->tipos() as $case)
                        <option value="{{ $case->value }}" wire:model="person.contacts.{{ $contactIndex }}.phones.{{ $phoneIndex }}.type" value="{{ $case->value }}"> {{ $case->label() }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>