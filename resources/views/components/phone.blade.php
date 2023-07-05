<div clas="row">
    <div class="col-12">
        <div class="row email-row">

            <div class="col-6">
                <label class="control-label">Telefone</label>
                <input wire:model.debounce.500ms="contacts.{{ $contactIndex }}.phones.{{ $phoneIndex }}.phone" class="form-control form-control-sm phone-input" @if($this->disableInputs) disabled @endif>
                @error('contacts.'.$contactIndex.'.phones.'.$phoneIndex.'.phone') <span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="col-6">
                <label class="control-label">Tipo</label>
                <select wire:model.debounce.500ms="person.contacts.{{ $contactIndex }}.phones.{{ $phoneIndex }}.type" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                    <option hidden>Selecione</option>
                    @foreach(App\Enums\Contact\ContactChannel::TELEFONE->tipos() as $case)
                        <option value="{{ $case->value }}"> {{ $case->label() }} </option>
                    @endforeach
                </select>
                @error('contacts.'.$contactIndex.'.phones.'.$phoneIndex.'.type') <span class="error">{{ $message }}</span>@enderror
            </div>

        </div>
    </div>
</div>