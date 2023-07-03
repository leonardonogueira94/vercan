@props(['readonly' => true])
@forelse($this->person->contacts as $index => $contact)
    @if($contact->is_default == true)
        @continue
    @endif
    <div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <label class="control-label">Nome</label>
                <input wire:model="person.contacts.{{ $index }}.contact_name" class="form-control form-control-sm" @if($readonly) disabled @endif>
                @error('person.contacts.' . $index . '.contact_name') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">Empresa</label>
                <input wire:model="contacts.{{ $index }}.company_name" class="form-control form-control-sm" @if($readonly) disabled @endif>
                @error('contacts.' . $index . '.company_name') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">Cargo</label>
                <input wire:model="contacts.{{ $index }}.job_title" class="form-control form-control-sm" @if($readonly) disabled @endif>
                @error('contacts.' . $index . '.job_title') <span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 phones">
                @foreach(array_filter($this->phones, fn($phone) => $phone['contact'] == $contact) as $phone)
                    <x-phone :phone="$phone"/>
                @endforeach
                @if(request()->route()->getName() != 'supplier.show')
                    <button wire:click="createPhone({{ $contact['index'] }})" class="btn btn-link" @if($readonly) disabled @endif>Adicionar</button>
                @endif
            </div>
            <div class="col-md-6 emails">
                @foreach(array_filter($this->emails, fn($email) => $email['contact'] == $contact) as $email)
                    <x-email :email="$email"/>
                @endforeach
                @if(request()->route()->getName() != 'supplier.show')
                    <button wire:click="createEmail({{ $contact['index'] }})" class="btn btn-link" @if($readonly) disabled @endif>Adicionar</button>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <hr>
            </div>
            <div class="col-1">
                <button wire:click="removeContact({{ $contact['index'] }})" class="d-flex justify-content-end w-100 btn btn-link" @if($readonly) disabled @endif>REMOVER</button>
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