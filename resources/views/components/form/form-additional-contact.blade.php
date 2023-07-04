@forelse($this->person->contacts as $contactIndex => $contact)
    @if($contact->is_default == true)
        @continue
    @endif
    <div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <label class="control-label">Nome</label>
                <input wire:model="person.contacts.{{ $contactIndex }}.contact_name" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                @error('person.contacts.' . $contactIndex . '.contact_name') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">Empresa</label>
                <input wire:model="contacts.{{ $contactIndex }}.company_name" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                @error('contacts.' . $contactIndex . '.company_name') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">Cargo</label>
                <input wire:model="contacts.{{ $contactIndex }}.job_title" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                @error('contacts.' . $contactIndex . '.job_title') <span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 phones">
                @foreach($contact->phones as $phoneIndex => $phone)
                    <x-phone :phone="$phone" contactIndex="{{ $contactIndex }}" phoneIndex="{{ $phoneIndex }}"/>
                @endforeach
                @if(request()->route()->getName() != 'supplier.show')
                    <button class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
                @endif
            </div>
            <div class="col-md-6 emails">
                @foreach($contact->emails as $emailIndex => $email)
                    <x-email :email="$email" contactIndex="{{ $contactIndex }}" emailIndex="{{ $emailIndex }}"/>
                @endforeach
                @if(request()->route()->getName() != 'supplier.show')
                    <button class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <hr>
            </div>
            <div class="col-1">
                <button wire:click="removeContact({{ $contact['index'] }})" class="d-flex justify-content-end w-100 btn btn-link" @if($this->disableInputs) disabled @endif>REMOVER</button>
            </div>
        </div>
    </div>
@empty
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            NÃO HÁ CONTATOS ADICIONAIS
        </div>
    </div>
@endforelse