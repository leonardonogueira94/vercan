@forelse(array_filter($this->contacts, fn($contact) => $contact['is_default'] == false) as $contactIndex => $contact)
    <x-contact :contact="$contact" contactIndex="{{ $contactIndex }}"/>
@empty
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            NÃO HÁ CONTATOS ADICIONAIS
        </div>
    </div>
@endif