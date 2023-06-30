<div class="form-group">
    @foreach($values as $case)
        <label class="radio-inline">
            <input 
            @if($wired) wire:model="{{ $name }}" wire:click="teste" @endif 
            type="radio" 
            name="{{ $name }}" 
            id="{{ "$case->name-$case->value" }}" 
            value="{{ $case->value }}"> {{ $case->label() }}
        </label>
    @endforeach
</div>