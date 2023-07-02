<div clas="row">
    <div class="col-12">
        <div class="row email-row">
            <div class="col-6">
                <label class="control-label">Email</label><sup>•</sup>
                <input wire:model="emails.{{ $email['contact']['index'] }}.email" class="form-control form-control-sm" required>
            </div>
            <div class="col-6">
                <label class="control-label">Tipo</label><sup>•</sup>
                <select class="form-control form-control-sm" required>
                    <option value="">Selecione</option>
                    @foreach(App\Enums\Contact\ContactChannel::EMAIL->tipos() as $case)
                        <option wire:model="emails.{{ $email['contact']['index'] }}.type" @if($case->value == $email['type']) {{ 'selected '}} @endif>{{ $case->label() }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>