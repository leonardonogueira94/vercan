@forelse($this->person->contacts as $contactIndex => $contact)
    @if($contact->is_default != true)
        @continue
    @endif
    <div>
        <div class="row">
            <div class="col-md-6 phones">
                @foreach($contact->phones as $phoneIndex => $phone)
                    <x-phone :phone="$phone" contactIndex="{{ $contactIndex }}" phoneIndex="{{ $phoneIndex }}"/>
                @endforeach
                @if(request()->route()->getName() != 'person.show')
                    <button wire:click="" class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
                @endif
            </div>
            <div class="col-md-6 emails">
                @foreach($contact->emails as $emailIndex => $email)
                    <x-email :email="$email" contactIndex="{{ $contactIndex }}" emailIndex="{{ $emailIndex }}"/>
                @endforeach
                @if(request()->route()->getName() != 'supplier.show')
                    <button wire:click="" class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
                @endif
            </div>
        </div>
    </div>
@empty
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <h4>NÃO HÁ CONTATOS PRINCIPAIS</h4>
        </div>
    </div>
@endforelse