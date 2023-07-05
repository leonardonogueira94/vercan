<div>
    <div class="row">
        <div class="col-12" wire:ignore>
            <textarea wire:model.debounce.500ms="person.observation" id="#editor" @if($this->disableInputs) disabled @endif form="edit-form"></textarea>
            @error('person.observation') <span class="error">{{ $message }}</span>@enderror
        </div>
    </div>
</div>

@once
    @push('head_js')
        <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
    @endpush
    @push('js')
        <script>

            CKEDITOR.replace('#editor', {
                on: {
                    change: function() {
                        @this.set('person.observation', this.getData())
                    }
                }
            })

        </script>
    @endpush
@endonce