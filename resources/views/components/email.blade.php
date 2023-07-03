<div clas="row">
    <div class="col-12">
        <div class="row email-row">
            <div class="col-6">
                <label class="control-label">Email</label>
                <input wire:model="emails.{{ $email['index'] }}.email" class="form-control form-control-sm">
            </div>
            <div class="col-6">
                <label class="control-label">Tipo</label>
                <select class="form-control form-control-sm">
                    <option hidden>Selecione</option>
                    @foreach(App\Enums\Contact\ContactChannel::EMAIL->tipos() as $case)
                        <option wire:model="emails.{{ $email['index'] }}.type" @if($case->value == $email['type']) {{ 'selected '}} @endif>{{ $case->label() }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>