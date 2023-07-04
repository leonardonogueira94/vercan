@if(is_array($email))
    <div clas="row" wire:key="{{ fake()->numerify('#####') }}">
        <div class="col-12">
            <div class="row email-row">
                <div class="col-6">
                    <label class="control-label">Email</label>
                    <input wire:model="emails.{{ $newEmailIndex }}.email" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                    @error('emails.{{ $newEmailIndex }}.email') <span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="col-6">
                    <label class="control-label">Tipo</label>
                    <select wire:model="emails.{{ $newEmailIndex }}.type" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Contact\ContactChannel::EMAIL->tipos() as $case)
                            <option value="{{ $case->value }}" @if(array_key_exists('type', $email) && $email['type'] == $case->value) selected @endif> {{ $case->label() }} </option>
                        @endforeach
                    </select>
                    @error('phones.{{ $newEmailIndex }}.type') <span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>
@else
    <div clas="row" wire:key="{{ fake()->numerify('#####') }}">
        <div class="col-12">
            <div class="row email-row">
                <div class="col-6">
                    <label class="control-label">Email</label>
                    <input wire:model="person.contacts.{{ $contactIndex }}.emails.{{ $emailIndex }}.email" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                </div>
                <div class="col-6">
                    <label class="control-label">Tipo</label>
                    <select wire:model="person.contacts.{{ $contactIndex }}.emails.{{ $emailIndex }}.type" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                        <option hidden>Selecione</option>
                        @foreach(App\Enums\Contact\ContactChannel::EMAIL->tipos() as $case)
                            <option value="{{ $case->value }}" @if($email->type == $case->value) selected @endif> {{ $case->label() }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@endif