@forelse(array_filter($this->contacts, fn($contact) => $contact['is_default'] == true) as $contactIndex => $contact)
    <div>
        <div class="row">
            <div class="col-md-6 phones">
                <!-- Mostra telefones que já estavam cadastrados -->
                @foreach($contact['phones'] as $phoneIndex => $phone)
                    <x-phone :phone="$phone" contactIndex="{{ $contactIndex }}" phoneIndex="{{ $phoneIndex }}"/>
                @endforeach

                <!-- Mostra botões apenas na edição/criação -->
                @if(!$this->disableInputs)
                    <button wire:click="addPhone({{ $contactIndex }})" class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
                    @if(count($contact['phones']) > 1)
                        <button wire:click="removePhone({{ $contactIndex }}, {{ $phoneIndex }})" class="btn btn-link float-right" @if($this->disableInputs) disabled @endif>Remover</button>
                    @endif
                @endif
            </div>

            <div class="col-md-6 emails">
                <!-- Mostra emails que já estavam cadastrados -->
                @foreach($contact['emails'] as $emailIndex => $email)
                    <x-email :email="$email" contactIndex="{{ $contactIndex }}" emailIndex="{{ $emailIndex }}"/>
                @endforeach

                <!-- Mostra botões apenas na edição/criação -->
                @if(!$this->disableInputs)
                    <button wire:click="addEmail({{ $contactIndex }})" class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
                    @if(count($contact['emails']) > 1)
                        <button wire:click="removeEmail({{ $contactIndex }}, {{ $emailIndex }})" class="btn btn-link float-right" @if($this->disableInputs) disabled @endif>Remover</button>
                    @endif
                @endif
            </div>
        </div>
    </div>
@empty
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            NÃO HÁ CONTATOS PRINCIPAIS
        </div>
    </div>
@endforelse