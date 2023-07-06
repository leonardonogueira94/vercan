<div class="form-group radio-group-enum">
    @foreach($values as $case)
        <label class="radio-inline">
            <input @if($wired) wire:model.debounce.500ms="{{ $name }}" @endif type="radio" name="{{ $name }}" value="{{ $case->value }}" @if($this->disableInputs) disabled @endif> {{ $case->label() }}
        </label>
    @endforeach
</div>