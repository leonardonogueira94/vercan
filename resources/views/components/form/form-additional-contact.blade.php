@if($this->person->contacts->where('is_default', false)->count() > 0)
    @foreach($this->person->contacts->where('is_registered', true)->where('is_default', false) as $contactIndex => $contact)
        <x-contact :contact="$contact" contactIndex="{{ $contactIndex }}"/>
    @endforeach
    @foreach($this->person->contacts->where('is_registered', false)->where('is_default', false) as $contactIndex => $contact)
        <x-contact :contact="$contact" contactIndex="{{ $contactIndex }}"/>
    @endforeach
@else
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            NÃO HÁ CONTATOS ADICIONAIS
        </div>
    </div>
@endif