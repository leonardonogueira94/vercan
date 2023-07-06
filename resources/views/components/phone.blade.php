<div clas="row">
    <div class="col-12">
        <div class="row email-row">

            <div class="col-6">
                <label class="control-label">Telefone</label>@if($contactIndex == 0 && $phoneIndex == 0) <sup>•</sup>@endif
                <input wire:model.defer="contacts.{{ $contactIndex }}.phones.{{ $phoneIndex }}.phone" value="{{ $this->contacts[$contactIndex]['phones'][$phoneIndex]['phone'] }}" class="form-control form-control-sm phone {{ $this->contacts[$contactIndex]['phones'][$phoneIndex]['type'] }}" @if($this->disableInputs) disabled @endif>
                @error('contacts.'.$contactIndex.'.phones.'.$phoneIndex.'.phone') <span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="col-6">
                <label class="control-label">Tipo</label>
                <select wire:model.debounce.500ms="contacts.{{ $contactIndex }}.phones.{{ $phoneIndex }}.type" value="{{ $this->contacts[$contactIndex]['phones'][$phoneIndex]['type'] }}" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
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
@once
    @push('js')
        <script>
            var phoneMask = new Inputmask("(99) 9999-9999");
            var cellphoneMask = new Inputmask("(99) 99999-9999");

            $('body').on('keyup', '.phone', function(e) {
                mask = phoneMask
                if($(this).hasClass('cellphone'))
                    mask = cellphoneMask
                mask.mask($(this));
                let phone = e.target.value;
                @this.set($(this).attr('wire:model.defer'), phone, true);
            });
        </script>
    @endpush
@endonce