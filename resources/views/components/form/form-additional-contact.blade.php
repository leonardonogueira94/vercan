@if($this->person->contacts->count() > 0 || count($this->contacts) > 0)
    @foreach($this->person->contacts->where('is_default', false) as $contactIndex => $contact)
        <x-contact contactIndex="{{ $contactIndex }}" :contact="$contact"/>
    @endforeach
    @foreach($this->contacts as $contactIndex => $contact)
        <x-contact wire:key="{{ fake()->numerify('#####') }}" contactIndex="{{ $contactIndex }}" :contact="$contact"/>
    @endforeach
@else
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            NÃO HÁ CONTATOS ADICIONAIS
        </div>
    </div>
@endif