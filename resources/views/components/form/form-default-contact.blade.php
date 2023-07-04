@forelse($this->person->contacts as $contact)

    @if($contact->is_default == false)
        @continue
    @endif

    <div>
        <div class="row">
            <div class="col-md-6 phones">
                <!-- Mostra telefones que já estavam cadastrados -->
                @foreach($contact->phones as $phone)
                    <x-phone :phone="$phone"/>
                @endforeach

                <!-- Mostra telefones que estão sendo cadastrados -->
                @foreach($this->phones as $phone)
                    @if((object) $phone->contact_id == $contact->id)
                        <x-phone :phone="$phone"/>
                    @endif
                @endforeach

                <!-- Mostra botões apenas na edição/criação -->
                @if(!$this->disableInputs)
                    <button wire:click="addPhone({{ $contact->id }})" class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
                @endif
            </div>

            <div class="col-md-6 emails">
                <!-- Mostra emails que já estavam cadastrados -->
                @foreach($contact->emails as $email)
                    <x-email :email="$email"/>
                @endforeach

                <!-- Mostra emails que estão sendo cadastrados -->
                @foreach($this->emails as $email)
                    @if((object) $email->contact_id) == $contact->id)
                        <x-email :email="$email"/>
                    @endif
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