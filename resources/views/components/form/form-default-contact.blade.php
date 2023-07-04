@forelse($this->person->contacts->where('is_default', true) as $contactIndex => $contact)
    <div>
        <div class="row">
            <div class="col-md-6 phones">
                <!-- Mostra telefones que já estavam cadastrados -->
                @foreach($contact->phones->where('is_registered', true) as $phoneIndex => $phone)
                    <x-phone :phone="$phone" contactIndex="{{ $contactIndex }}" phoneIndex="{{ $phoneIndex }}"/>
                @endforeach

                <!-- Mostra telefones que estão sendo cadastrados -->
                @foreach($contact->phones->where('is_registered', false) as $phoneIndex => $phone)
                    <x-phone :phone="$phone" contactIndex="{{ $contactIndex }}" phoneIndex="{{ $phoneIndex }}"/>
                @endforeach

                <!-- Mostra botões apenas na edição/criação -->
                @if(!$this->disableInputs)
                    <button wire:click="addPhone({{ $contact->id }})" class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
                @endif
            </div>

            <div class="col-md-6 emails">
                <!-- Mostra emails que já estavam cadastrados -->
                @foreach($contact->emails->where('is_registered', true) as $emailIndex => $email)
                    <x-email :email="$email" contactIndex="{{ $contactIndex }}" emailIndex="{{ $emailIndex }}"/>
                @endforeach

                <!-- Mostra emails que estão sendo cadastrados -->
                @foreach($contact->emails->where('is_registered', false) as $emailIndex => $email)
                    <x-email :email="$email" contactIndex="{{ $contactIndex }}" emailIndex="{{ $emailIndex }}"/>
                @endforeach

                <!-- Mostra botões apenas na edição/criação -->
                @if(!$this->disableInputs)
                    <button wire:click="addEmail({{ $contact->id }})" class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
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