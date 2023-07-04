@if(is_array($phone))
    <div clas="row">
        <div class="col-12">
            <div class="row email-row">
                <div class="col-6">
                    <label class="control-label">Telefone</label>
                    <input wire:model="phones.{{ $newPhoneIndex }}.phone" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                    @error('phones.{{ $newPhoneIndex }}.phone') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-6">
                    <label class="control-label">Tipo</label>
                    <select wire:model="phones.{{ $newPhoneIndex }}.type" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Contact\ContactChannel::TELEFONE->tipos() as $case)
                            <option value="{{ $case->value }}" @if(array_key_exists('type', $email) && $email['type'] == $case->value) selected @endif> {{ $case->label() }} </option>
                        @endforeach
                    </select>
                    @error('phones.{{ $newPhoneIndex }}.type') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>
@else
    <div clas="row">
        <div class="col-12">
            <div class="row email-row">
                <div class="col-6">
                    <label class="control-label">Telefone</label>
                    <input wire:model="person.contacts.{{ $contactIndex }}.phones.{{ $phoneIndex }}.phone" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                    @error('person.contacts.{{ $contactIndex }}.phones.{{ $phoneIndex }}.phone') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-6">
                    <label class="control-label">Tipo</label>
                    <select wire:model="person.contacts.{{ $contactIndex }}.phones.{{ $phoneIndex }}.type" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Contact\ContactChannel::TELEFONE->tipos() as $case)
                            <option value="{{ $case->value }}"> {{ $case->label() }} </option>
                        @endforeach
                    </select>
                    @error('person.contacts.{{ $contactIndex }}.phones.{{ $phoneIndex }}.type') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>
@endif