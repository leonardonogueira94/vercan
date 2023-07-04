<div>
    <div class="row">
        <div class="col-lg-6 col-12">
            <label class="control-label">Nome</label>
            <input wire:model="person.contacts.{{ $contact->index }}.contact_name" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
            @error('person.contacts.' . $contact->index . '.contact_name') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Empresa</label>
            <input wire:model="person.contacts.{{ $contact->index }}.company_name" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
            @error('person.contacts.' . $contact->index . '.company_name') <span class="error">{{ $message }}</span>@enderror
        </div>
        <div class="col-lg-3 col-12">
            <label class="control-label">Cargo</label>
            <input wire:model="person.contacts.{{ $contact->index }}.job_title" class="form-control form-control-sm" @if($this->disableInputs) disabled @endif>
            @error('person.contacts.' . $contact->index . '.job_title') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 phones">
            @foreach($contact->phones as $phone)
                <x-phone :phone="$phone"/>
            @endforeach
            @if(request()->route()->getName() != 'supplier.show')
                <button class="btn btn-link" @if($this->disableInputs) disabled @endif>Adicionar</button>
            @endif
        </div>
        <div class="col-md-6 emails">
            @foreach($contact->emails as $email)
                <x-email :email="$email"/>
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