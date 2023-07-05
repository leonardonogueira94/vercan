<div clas="row">
    <div class="col-12">
        <div class="row email-row">
            <div class="col-6">
                <label class="control-label">Email</label>
                <input wire:model.debounce.500ms="contacts.{{ $contactIndex }}.emails.{{ $emailIndex }}.email" class="form-control form-control-sm email-input" @if($this->disableInputs) disabled @endif>
                @error('contacts.'.$contactIndex.'.emails.'.$emailIndex.'.email') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-6">
                <label class="control-label">Tipo</label>
                <select wire:model.debounce.500ms="contacts.{{ $contactIndex }}.emails.{{ $emailIndex }}.type" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                    <option hidden>Selecione</option>
                    @foreach(App\Enums\Contact\ContactChannel::EMAIL->tipos() as $case)
                        <option value="{{ $case->value }}" @if($email['type'] == $case->value) selected @endif> {{ $case->label() }} </option>
                    @endforeach
                </select>
                @error('contacts.'.$contactIndex.'.emails.'.$emailIndex.'.type') <span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
</div>