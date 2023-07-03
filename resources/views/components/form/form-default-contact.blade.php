@forelse($this->contacts as $contact)
    @if($contact['is_default'] != true)
        @continue
    @endif
    <div>
        <div class="row">
            <div class="col-md-6 phones">
                @foreach(array_filter($this->phones, fn($phone) => $phone['contact'] == $contact) as $phone)
                    <x-phone :phone="$phone"/>
                @endforeach
                @if(request()->route()->getName() != 'supplier.show')
                    <button wire:click="createPhone({{ $contact['index'] }})" class="btn btn-link">Adicionar</button>
                @endif
            </div>
            <div class="col-md-6 emails">
                @foreach(array_filter($this->emails, fn($email) => $email['contact'] == $contact) as $email)
                    <x-email :email="$email"/>
                @endforeach
                @if(request()->route()->getName() != 'supplier.show')
                    <button wire:click="createEmail({{ $contact['index'] }})" class="btn btn-link">Adicionar</button>
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