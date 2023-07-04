@if(is_array($contact))
    <div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <label class="control-label">Nome</label>
                <input wire:model="contacts.{{ $contactIndex }}.contact_name" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                @error('person.contacts.' . $contactIndex . '.contact_name') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">Empresa</label>
                <input wire:model="contacts.{{ $contactIndex }}.company_name" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                @error('person.contacts.' . $contactIndex . '.company_name') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">Cargo</label>
                <input wire:model="contacts.{{ $contactIndex }}.job_title" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                @error('person.contacts.' . $contactIndex . '.job_title') <span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 phones">
                @foreach($this->phones as $phoneIndex => $phone)
                    @if($phone['contact_id'] == $contact['id'])
                        <x-phone :phone="$phone" contactIndex="{{ $contactIndex }}" phoneIndex="{{ $phoneIndex }}"/>
                    @endif
                @endforeach
                @if(request()->route()->getName() != 'supplier.show')
                    <button wire:click="addPhone({{ $contact['id'] }})" class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
                @endif
            </div>
            <div class="col-md-6 emails">
                @foreach($contact['emails'] as $emailIndex => $email)
                    @if($email['contact_id'] == $contact['id'])
                        <x-email :email="$email" contactIndex="{{ $contactIndex }}" emailIndex="{{ $emailIndex }}" wire:key="{{ fake()->numerify('#####') }}" />
                    @endif
                @endforeach
                @if(request()->route()->getName() != 'supplier.show')
                    <button wire:click="addEmail({{ $contact['id'] }})" class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <hr>
            </div>
            <div class="col-1">
                <button wire:click="removeContact({{ $contact['id'] }})" class="d-flex justify-content-end w-100 btn btn-link" @if($this->disableInputs) disabled @endif>REMOVER</button>
            </div>
        </div>
    </div>
@else
    <div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <label class="control-label">Nome</label>
                <input wire:model="person.contacts.{{ $contactIndex }}.contact_name" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                @error('person.contacts.' . $contactIndex . '.contact_name') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">Empresa</label>
                <input wire:model="person.contacts.{{ $contactIndex }}.company_name" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                @error('person.contacts.' . $contactIndex . '.company_name') <span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="col-lg-3 col-12">
                <label class="control-label">Cargo</label>
                <input wire:model="person.contacts.{{ $contactIndex }}.job_title" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
                @error('person.contacts.' . $contactIndex . '.job_title') <span class="error">{{ $message }}</span>@enderror
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
                    <button wire:click="addEmail({{ $contact->id }})" class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <hr>
            </div>
            <div class="col-1">
                <button wire:click="removeContact({{ $contact->id }})" class="d-flex justify-content-end w-100 btn btn-link" @if($this->disableInputs) disabled @endif>REMOVER</button>
            </div>
        </div>
    </div>
@endif