<div clas="row">
    <div class="col-12">
        <div class="row email-row">

            <div class="col-6">
                <label class="control-label">Telefone</label>
                <input wire:model="person.contacts.{{ $phone->contact_index }}.phones.{{ $phone->index }}.phone" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                @error('person.contacts.{{ $phone->contact_index }}.phones.{{ $phone->index }}.phone') <span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="col-6">
                <label class="control-label">Tipo</label>
                <select wire:model="person.contacts.{{ $phone->contact_index }}.phones.{{ $phone->index }}.type" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                    <option hidden>Selecione</option>
                    @foreach(App\Enums\Contact\ContactChannel::TELEFONE->tipos() as $case)
                        <option value="{{ $case->value }}"> {{ $case->label() }} </option>
                    @endforeach
                </select>
                @error('person.contacts.{{ $phone->contact_index }}.phones.{{ $phone->index }}.type') <span class="error">{{ $message }}</span>@enderror
            </div>

        </div>
    </div>
</div>